<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Encryption Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure the encryption options for your application.
    | The key should be a secure random string and the method should be
    | one of the supported encryption methods by OpenSSL.
    |
    */

    'key' => env('ENCRYPT_KEY', '12345678123456781234567812345678'),
    'method' => env('ENCRYPT_METHOD', 'AES-256-CBC'),
];