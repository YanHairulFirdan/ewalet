<?php

namespace App\DokuUtil;

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
    private $signatureComponents;

    private $headerSignature;

    private $signature;

    public function __construct($requestBody)
    {
        $this->requestBody = $requestBody;
        $this->build();
    }

    private function build()
    {
        $this->setSignatureComponents();
        $this->createSignature();
        $this->createHeaderSignature();
    }

    private function setSignatureComponents()
    {
        $this->signatureComponents = [
            'Client-Id'         => $this->getClientID(),
            'Request-Id'        => $this->generateRequestID(),
            'Request-Timestamp' => now()->toDateTimeLocalString() . 'Z',
            'Request-Target'    => config('doku.request_target'),
        ];
    }

    public function createSignature()
    {
        $secretKey       = $this->getSecretID();
        $components      = $this->withDigest();
        $this->signature = "Client-Id:" . $components['Client-Id'] . "\n"
            . "Request-Id:" . $components['Request-Id'] . "\n"
            . "Request-Timestamp:" . $components['Request-Timestamp'] . "\n"
            . "Request-Target:" . $components['Request-Target'] . "\n"
            . "Digest:" . $components['Digest'];

        $this->signature = base64_encode(hash_hmac('sha256', $this->signature, $secretKey, true));
    }

    private function createDigest()
    {
        return base64_encode(hash('sha256', json_encode($this->requestBody), true));
    }

    private function withDigest()
    {
        return array_merge($this->signatureComponents, ['Digest' => $this->createDigest()]);
    }

    private function withSignature()
    {
        $signature = 'HMACSHA256=' . base64_encode(hash_hmac('sha256', $this->signature, $this->getSecretID(), true));

        return array_merge($this->signatureComponents, ['Signature' => 'HMACSHA256=' . $this->signature]);
    }

    private function createHeaderSignature()
    {
        $this->headerSignature = 'HMACSHA256=' . base64_encode(hash_hmac('sha256', $this->signature, $this->getSecretID(), true));
    }

    public function getHeaderSignature()
    {
        return $this->headerSignature;
    }

    public function getHeader()
    {
        return $this->withSignature();
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
