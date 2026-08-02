#!/usr/bin/env node
/**
 * Pre-commit secret scanner (zero dependencies).
 *
 * Default:  scans staged changes (git diff --cached).
 * --all:    scans every tracked file (git ls-files).
 *
 * Exits 1 if any potential secret is found so the commit can be aborted.
 */
import { spawnSync } from 'node:child_process';
import fs from 'node:fs';

const SCAN_ALL = process.argv.includes('--all');

const SKIP_FILE = /(^|\/)(node_modules|vendor|\.git)\/|\.(png|jpe?g|gif|svg|ico|webp|woff2?|ttf|eot|otf|zip|gz|jar|pdf|sqlite|lock|min\.css|min\.js)$/i;

const SECRET_PATTERNS = [
    { name: 'private key block', re: /-----BEGIN [A-Z0-9 ]*PRIVATE KEY-----/ },
    { name: 'aws access key', re: /\bAKIA[0-9A-Z]{16}\b/ },
    { name: 'github token', re: /\b(gh[pousr]_|github_pat_)[A-Za-z0-9_]{20,}\b/ },
    { name: 'stripe secret key', re: /\bsk_live_[0-9a-zA-Z]{16,}\b/ },
    { name: 'slack token', re: /\bxox[baprs]-[0-9A-Za-z-]{10,}\b/ },
    { name: 'google api key', re: /\bAIza[0-9A-Za-z\-_]{35}\b/ },
    { name: 'jwt token', re: /\beyJ[A-Za-z0-9_-]{8,}\.eyJ[A-Za-z0-9_-]{8,}\./ },
    {
        name: 'credential assignment',
        re: /(?<![\w\->.])\b(APP_KEY|DB_PASSWORD|MAIL_PASSWORD|REDIS_PASSWORD|AWS_SECRET_ACCESS_KEY|AWS_ACCESS_KEY_ID|ADMIN_PASSWORD|CLIENT_SECRET|APP_SECRET|JWT_SECRET|SECRET_KEY|PRIVATE_KEY|PASSWORD|SECRET|API_KEY|TOKEN)\s*(?:=>|=|:(?!:))\s*(\S+)/i,
    },
];

const PLACEHOLDER = /^(null|true|false|undefined|nil|change-me|changeme|password|secret|example|test|sample|your[-_ ].*|your|todo|<.*>|\{\{.*\}\}\.\.\.)$/i;
const SAFE_EXPR = /^(env\s*\(|config\s*\(|getenv\s*\(|[\w\\]+::|\$\w+|[[({])/;

function looksLikeSecretValue(raw) {
    let v = raw.replace(/,$/, '').trim();
    v = v.replace(/^['"]/, '').replace(/['"]$/, '');

    if (!v || v.length < 6) {
        return false;
    }

    if (PLACEHOLDER.test(v)) {
        return false;
    }

    if (SAFE_EXPR.test(v)) {
        return false;
    }

    return true;
}

function runGit(args) {
    const result = spawnSync('git', args, { encoding: 'utf8', maxBuffer: 32 * 1024 * 1024 });
    if (result.status !== 0) {
        return [];
    }
    return result.stdout.split(/\r?\n/).filter(Boolean);
}

function filesToScan() {
    if (SCAN_ALL) {
        return runGit(['ls-files']);
    }
    return runGit(['diff', '--cached', '--name-only', '--diff-filter=ACMR', '--', '.']);
}

function stagedContent(path) {
    const result = spawnSync('git', ['show', `:${path}`], { encoding: 'utf8', maxBuffer: 32 * 1024 * 1024 });
    if (result.status === 0) {
        return result.stdout;
    }
    return fs.existsSync(path) ? fs.readFileSync(path, 'utf8') : null;
}

const PRIVATE_KEY_FILE = /\.(pem|p12|pfx|jks|keystore)$/i;
const PRIVATE_KEY_NAME = /(^|\/)(id_rsa|id_ed25519|id_ecdsa|id_dsa|github_rsa)$/;

let violations = 0;

for (const file of filesToScan()) {
    if (SKIP_FILE.test(file)) {
        continue;
    }

    if (PRIVATE_KEY_FILE.test(file) || PRIVATE_KEY_NAME.test(file)) {
        console.log(`${file}:1: private key file`);
        violations += 1;
        continue;
    }

    const content = stagedContent(file);
    if (content === null) {
        continue;
    }

    content.split(/\r?\n/).forEach((line, index) => {
        for (const pattern of SECRET_PATTERNS) {
            const match = pattern.re.exec(line);
            if (!match) {
                continue;
            }

            if (pattern.name === 'credential assignment' && !looksLikeSecretValue(match[2])) {
                continue;
            }

            console.log(`${file}:${index + 1}: ${pattern.name}`);
            violations += 1;
        }
    });
}

if (violations > 0) {
    console.error(`\n[check-secrets] ${violations} potential secret(s) found. Review and remove them before committing.`);
    process.exit(1);
}

console.log('[check-secrets] no secrets detected.');
