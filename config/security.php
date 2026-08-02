<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Security Headers
    |--------------------------------------------------------------------------
    | Toggles and values for the SecurityHeaders middleware.
    */

    // HSTS: only enable when serving over HTTPS.
    'hsts' => (bool) env('SECURITY_HSTS', false),

    // HSTS max-age in seconds (6 months default).
    'hsts_max_age' => (int) env('SECURITY_HSTS_MAX_AGE', 15768000),

    // X-Frame-Options value (DENY, SAMEORIGIN, or none).
    'frame_options' => env('SECURITY_FRAME_OPTIONS', 'SAMEORIGIN'),

    // Content-Security-Policy: set to true to enable a restrictive default CSP.
    // Public pages load scripts/fonts from CDNs, so this may need refinement.
    'csp_enabled' => (bool) env('SECURITY_CSP_ENABLED', false),
];
