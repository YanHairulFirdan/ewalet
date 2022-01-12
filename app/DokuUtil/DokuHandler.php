<?php

namespace App\DokuUtil;

use App\Models\User;
use DOKU\Client;
use DOKU\Common\Utils;
use GuzzleHttp\Client as GuzzleHttpClient;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

use function PHPSTORM_META\map;

class DokuHandler
{
    use DokuTrait;

    private $request;

    private $header;

    private $body;

    private $response;

    private $util;

    private $httpcode;

    /**
     * property for store object from doku client
     *
     * @var Doku\Client
     */
    public GuzzleHttpClient $dokuClient;

    public function __construct($amount, $invoiceNumber, $dataCustomer, $items = null)
    {
        $this->generateBody($amount, $invoiceNumber, $dataCustomer, $items);
        $this->setHeader();
    }

    private function setHeader()
    {
        $this->util            = new SignatureUtil($this->body);
        $this->header    = $this->util->getHeader();
        $this->signature = $this->util->getSignature();
    }

    private function generateBody($amount, $invoiceNumber, $dataCustomer, $items = null)
    {
        $this->body = [
            'order' => [
                'amount' => $amount,
                'invoice_number' => $invoiceNumber,
                'currency' => config('doku.currency'),
                'callback_url' => 'https://doku.com',
                'session_id' => Str::random()
            ],
            'payment' => [
                'payment_due_date' => 60,
            ],
            'customer' => array_merge($dataCustomer, ['address' => Str::random(), 'country' => 'ID']),
        ];

        if ($items) $this->body['order']['line_items'] = $items;
    }

    public function makeRequest()
    {
        $ch = curl_init($this->getEndPointAPI());
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($this->body));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt(
            $ch,
            CURLOPT_RETURNTRANSFER,
            true
        );

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Signature:' . $this->header['Signature'],
            'Request-Id:' . $this->header['Request-Id'],
            'Client-Id:' . $this->header['Client-Id'],
            'Request-Timestamp:' . $this->header['Request-Timestamp'],
            'Request-Target:' . $this->header['Request-Target'],

        ));

        $this->response = curl_exec($ch);
        $this->httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);
    }

    public function getPaymentUrl()
    {
        $responseBody = json_decode($this->response, true);

        return $responseBody['credit_card_payment_page']['url'];
    }

    public function getSignature()
    {
        return $this->util->getSignature();
    }

    public function isRequestSuccess()
    {
        return $this->httpcode == 200;
    }
}
