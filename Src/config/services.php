<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],



// Facebook service
    'facebook' => [
        'client_id' => '184565778656925',
        'client_secret' => 'fbe2bbc78dd47dddf640527cc24ac030',
        'redirect' => 'http://localhost:8000/auth/facebook/callback',
    ],




//GitHub service
    'github' => [
        'client_id' => '82921b5e8f1a7c31f71c',
        'client_secret' => '00be95789293aceded1bde5f691f0660951b0123',
        'redirect' => 'http://localhost:8000/auth/github/callback',
    ],

];
