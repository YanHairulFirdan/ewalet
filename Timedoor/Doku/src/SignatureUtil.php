<?php

namespace Timedoor\Doku;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class SignatureUtil
{
    use DokuTrait;

    private $requestBody;
    /**
     * arrray for create signature
     *
     * @var Array
     */
    private $components;

    private $signature;

    public function __construct($requestBody, $components = null)
    {
        $this->requestBody = $requestBody;
        $this->components  = $components;
        $this->createSignature();
    }

    public function createSignature()
    {
        $secretKey       = $this->getSecretID();
        $components      = $this->componentsWithDigest();
        $this->signature =
            "Client-Id:" . $components['Client-Id'] . "\n"
            . "Request-Id:" . $components['Request-Id'] . "\n"
            . "Request-Timestamp:" . $components['Request-Timestamp'] . "\n"
            . "Request-Target:" . $components['Request-Target'] . "\n"
            . "Digest:" . $components['Digest'];

        $this->signature = 'HMACSHA256=' . base64_encode(hash_hmac('sha256', $this->signature, $secretKey, true));
    }

    private function createDigest()
    {
        $body = is_array($this->requestBody)
            ? json_encode($this->requestBody)
            : $this->requestBody;

        return base64_encode(hash('sha256', $body, true));
    }

    private function componentsWithDigest()
    {
        return array_merge($this->components, ['Digest' => $this->createDigest()]);
    }

    public function getSignature()
    {
        return $this->signature;
    }

    private function generateRequestID()
    {
        return Str::random();
    }
}
