<?php
return [
    'api_endpoint_sandbox_dev'  => 'https://api-sandbox.doku.com/credit-card/v1/payment-page',
    'api_endpoint_sandbox_prod' => 'https://api.doku.com/credit-card/v1/payment-page',
    'currency'                  => 'IDR',
    'payment_method_types'      => [
        'CREDIT_CARD'
    ],
    'request_target'            => '/credit-card/v1/payment-page',
    'request_target_inquiry'    => '/api/notify',
    'payment_due_date'          => 60,
    'client_id_dev'             => env('DOKU_CLIENT_KEY_ID_DEV', ''),
    'client_id_prod'            => env('DOKU_CLIENT_KEY_ID_PROD', ''),
    'secret_id_dev'             => env('DOKU_SECRET_KEY_ID_DEV', ''),
    'secret_id_prod'            => env('DOKU_SECRET_KEY_ID_PROD', ''),
    'callback_url'              => 'https://mirahproperty.com',
];
