<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Your Crowdin OAuth2 Credentials
    |--------------------------------------------------------------------------
    */

    'clientId' => env('CROWDIN_CLIENT_ID'),

    'clientSecret' => env('CROWDIN_SECRET'),

    'access_token' => env('CROWDIN_ACCESS_TOKEN'),

    'base_uri' => env('CROWDIN_BASE_URI', 'https://crowdin.com/api/v2')

];
