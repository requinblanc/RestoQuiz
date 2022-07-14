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
        'scheme' => 'https',
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
        'client_id' => '387980146496473',
        'client_secret' => 'b84587c6ad297aaa52827aeabc6e031b',
        'redirect' => 'http://localhost:8000/callback',
    ],

    'google' => [
        'client_id' => '781780697494-knfbhea64s9v91q0kjvmtsijmi8qmqpl.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'http://localhost:8000/authorized/google/callback',
    ],


];
