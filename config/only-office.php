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

    'host' => env('ONLY_OFFICE_HOST', 'http://localhost:8181'),
    'algorithm' => env('ALGORITHM', 'HS256'),
    'secretToken' => env('SECRET_TOKEN', 'oA2Jzht2MTeQtYOL48rsC19ZD8BP4T'),

];
