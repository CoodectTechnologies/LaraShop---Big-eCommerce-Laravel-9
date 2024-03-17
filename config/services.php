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

    'google' => [
        'status' => (boolean) env('GOOGLE_STATUS'),
        'client_id' => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),
        'redirect' => env('GOOGLE_REDIRECT_URL'),
    ],

    'stripe' => [
        'status' => (boolean) env('STRIPE_STATUS'),
        'public' => env('STRIPE_PUBLIC_KEY'),
        'secret' => env('STRIPE_SECRET_KEY')
    ],

    'mercadopago' => [
        'status' => (boolean) env('MERCADOPAGO_STATUS'),
        'url' => env('MERCADOPAGO_URL'),
        'key' => env('MERCADOPAGO_PUBLIC_KEY'),
        'token' => env('MERCADOPAGO_ACCESS_TOKEN'),
        'country_code' => env('MERCADOPAGO_COUNTRY_CODE'),
        'currency_code' => env('MERCADOPAGO_CURRENCY_CODE')
    ],

    'paypal' => [
        'status' => (boolean) env('PAYPAL_STATUS'),
        'client_id' => env('PAYPAL_CLIENT_ID')
    ],

    'transfer' => [
        'status' => (boolean) env('TRANSFER_STATUS'),
        'account_bank' => env('TRANSFER_ACCOUNT_BANK'),
        'target' => env('TRANSFER_TARGET'),
        'bank' => env('TRANSFER_BANK'),
        'name' => env('TRANSFER_NAME')
    ]
];
