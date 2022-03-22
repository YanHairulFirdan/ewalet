<?php

namespace App\DokuUtil;

use Illuminate\Http\Request;

class DokuResponseHandler
{
    /** @var \Illuminate\Http\Request $request instance  */
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    /**
     * method for setup signature util
     *
     *
     * @param Illuminate\Http\Request $var Description
     * @return void
     **/
    public function verifySignature()
    {
        $headers          = $this->request->header();
        $components       =
            [
                'Client-Id'         => $headers['client-id'][0],
                'Request-Id'        => $headers['request-id'][0],
                'Request-Timestamp' => $headers['request-timestamp'][0],
                'Request-Target'    => config('doku.request_target')
            ];
        $notificationBody = file_get_contents('php://input');

        return (new SignatureUtil($notificationBody, $components))->getSignature() == $headers['signature'][0];
    }

    public function getInvoice()
    {
        return $this->request->order['invoice_number'];
    }
}
