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
        'client_id' => '438166827758859',  //client face của bạn
        'client_secret' => 'acbdeb30be5b0756a285b3df0dc7e5ed',  //client app service face của bạn
        'redirect' => 'http://localhost/shopbanhanglaravel/admin/callback' //callback trả về
    ],

    
    'google' => [
        'client_id' => '64258202048-bf8g8jo3qmakkge2o4isujigponr4le3.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'http://localhost/shopbanhanglaravel/google/callback' 
    ],



];
