<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'facebook' => [
        'client_id' => '6086741331421236',
        'client_secret' => 'b47a253831e995e508d33d241d211495',
        'redirect' => 'http://phanminhhung.com.vn/auth/facebook/callback',
    ],

    'google' => [
        'client_id' => '774271633117-trgru401lsue21a9hnik05ri6qj8p7g5.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'http://phanminhhung.com.vn/auth/google/callback',
    ],
    'cloudflare' => [
        'turnstile' => [
            'site_key' => env('TURNSTILE_SITE_KEY'),
            'site_secret' => env('TURNSTILE_SITE_SECRET'),
        ]
    ],
    'recaptcha_v2' => [
        'siteKey' => env('RECAPTCHA_V2_SITE_KEY'),
        'secretKey' => env('RECAPTCHA_V2_SECRET_KEY'),
    ],
];
