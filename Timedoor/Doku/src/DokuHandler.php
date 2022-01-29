<?php

namespace Timedoor\Doku;

use GuzzleHttp\Client as GuzzleHttpClient;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class DokuHandler
{
    use DokuTrait;

    private $request;

    private $headers;

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
        $this->headers              =
            [
                'Client-Id'         => $this->getClientID(),
                'Request-Id'        => Str::random(),
                'Request-Timestamp' => now()->toDateTimeLocalString() . 'Z',
                'Request-Target'    => config('doku.request_target'),
            ];
        $this->util                 = new SignatureUtil($this->body, $this->headers);
        $this->headers['Signature'] = $this->util->getSignature();

        Log::info($this->headers);
    }

    private function generateBody($amount, $invoiceNumber, $dataCustomer, $items = null)
    {
        $this->body = [
            'order'   => [
                'amount'         => $amount,
                'invoice_number' => $invoiceNumber,
                'currency'       => config('doku.currency'),
                'callback_url'   => config('doku.callback_url'),
                'session_id'     => Str::random()
            ],
            'payment'  => [
                'payment_due_date' => config('doku.payment_due_date'),
            ],
            'customer' => array_merge(
                $dataCustomer,
                [
                    'country' => 'ID'
                ]
            ),
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
            'Signature:' . $this->headers['Signature'],
            'Request-Id:' . $this->headers['Request-Id'],
            'Client-Id:' . $this->headers['Client-Id'],
            'Request-Timestamp:' . $this->headers['Request-Timestamp'],
            'Request-Target:' . $this->headers['Request-Target'],
        ));

        $this->response = curl_exec($ch);
        $this->httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        Log::info('ok');
        Log::info($this->response);

        curl_close($ch);
    }

    public function getPaymentUrl()
    {
        $responseBody = json_decode($this->response, true);

        Log::info([$responseBody, $this->httpcode]);

        return $responseBody['response']['payment']['url'];
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
