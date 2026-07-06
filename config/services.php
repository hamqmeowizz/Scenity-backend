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

    'openweather' => [
        'key' => env('OPENWEATHER_API_KEY'),
        'city' => env('OPENWEATHER_CITY', 'Kuala Lumpur,MY'),
    ],

    'google_weather' => [
        'key' => env('GOOGLE_WEATHER_API_KEY'),
        'latitude' => env('GOOGLE_WEATHER_LATITUDE', '3.1390'),
        'longitude' => env('GOOGLE_WEATHER_LONGITUDE', '101.6869'),
        'location_name' => env('GOOGLE_WEATHER_LOCATION_NAME', 'Kuala Lumpur,MY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

];
