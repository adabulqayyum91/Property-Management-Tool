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
        'client_id' => '230549744795507',
        'client_secret' => '9ba1bbbb947085706923e03fe7b2c62e',
        'redirect' => 'http://localhost:8000/callback',
    ],
    'google' => [
        'client_id' => '352677919392-fmik4a26dv71j15of1ep6unbftvgrfu2.apps.googleusercontent.com',
        'client_secret' => '4TsOOuBXq3RVQ7AXmg1khXJ3',
        'redirect' => 'http://localhost:8000/auth/google/callback',
    ],
    'stripe' => [
        'model'  => App\Models\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
];
