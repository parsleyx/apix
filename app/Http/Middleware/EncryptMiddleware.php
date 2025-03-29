<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EncryptMiddleware
{
    private string $key;
    private string $method;

    public function __construct()
    {
        $this->key = config('encrypt.key');
        $this->method = config('encrypt.method');
    }

    public function handle(Request $request, Closure $next): Response
    {
        $crypto = $request->header('crypto');
        if ($request->isMethod('POST') && $crypto == "on") {
            $encryptedData = $request->getContent();
            $decryptedData = $this->decrypt($encryptedData);
            $request->merge(json_decode($decryptedData, true) ?? []);
        }

        $response = $next($request);

        if ($response->getContent() && $crypto == "on") {
            $responseData = $response->getContent();
            $encryptedResponse = $this->encrypt($responseData);
            $response->setContent($encryptedResponse);
        }

        return $response;
    }

    private function encrypt(string $data): string
    {
        $ivLength = openssl_cipher_iv_length($this->method);
        $iv = openssl_random_pseudo_bytes($ivLength);
        $encrypted = openssl_encrypt($data, $this->method, $this->key, OPENSSL_RAW_DATA, $iv);
        return base64_encode($iv . $encrypted);
    }

    private function decrypt(string $data): string
    {
        $data = base64_decode($data);
        $ivLength = openssl_cipher_iv_length($this->method);
        $iv = substr($data, 0, $ivLength);
        $encrypted = substr($data, $ivLength);
        return openssl_decrypt($encrypted, $this->method, $this->key, OPENSSL_RAW_DATA, $iv);
    }
}