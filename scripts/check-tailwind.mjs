#!/usr/bin/env node
/**
 * Tailwind/CSS lint gate (zero dependencies).
 *
 * Runs the production build and fails when it emits unexpected warnings so
 * new Tailwind/Vite warnings break `npm run lint` instead of silently
 * slipping through. Known-benign warnings (chunk size, plugin timings) are
 * reported as info only.
 */
import { spawnSync } from 'node:child_process';

const run = spawnSync('npm', ['run', 'build'], { encoding: 'utf8', shell: true });
const output = `${run.stdout ?? ''}\n${run.stderr ?? ''}`;

if (run.status !== 0) {
    console.error(output);
    console.error('[lint:css] build failed.');
    process.exit(1);
}

const stripAnsi = (line) => line.replace(/\u001b\[[0-9;]*m/g, '').trim();

const warnings = output
    .split(/\r?\n/)
    .filter((line) => /(\(!\)|warning|warn)/i.test(line))
    .filter((line) => !/(chunks are larger than|PLUGIN_TIMINGS|plugin `laravel`|chunkSizeWarningLimit|codeSplitting|build\.rolldownOptions)/i.test(line))
    .map(stripAnsi)
    .filter(Boolean);

if (warnings.length > 0) {
    console.error(`[lint:css] build warnings found:\n${warnings.join('\n')}`);
    process.exit(1);
}

console.log('[lint:css] build clean (no unexpected warnings).');
