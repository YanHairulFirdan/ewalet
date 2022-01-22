<?php
return [
    'api_endpoint_sandbox_dev'  => 'https://api-sandbox.doku.com/checkout/v1/payment',
    'api_endpoint_sandbox_prod' => 'https://api.doku.com/checkout/v1/payment',
    // 'api_endpoint_sandbox_dev'  => 'https://api-sandbox.doku.com/credit-card/v1/payment-page',
    // 'api_endpoint_sandbox_prod' => 'https://api.doku.com/credit-card/v1/payment-page',
    'currency'                  => 'IDR',
    'payment_method_types'      => [
        // 'CREDIT_CARD'
        "VIRTUAL_ACCOUNT_BCA",
        "VIRTUAL_ACCOUNT_BANK_MANDIRI",
        "VIRTUAL_ACCOUNT_BANK_SYARIAH_MANDIRI",
        "VIRTUAL_ACCOUNT_BRI",
        "VIRTUAL_ACCOUNT_DOKU",
        "VIRTUAL_ACCOUNT_PERMATA",
        "VIRTUAL_ACCOUNT_BNI",
        "VIRTUAL_ACCOUNT_CIMB",
        "VIRTUAL_ACCOUNT_DANAMON",
        "ONLINE_TO_OFFLINE_ALFA",
        "CREDIT_CARD",
        "DIRECT_DEBIT_BRI",
        "QRIS"
    ],
    'request_target'            => '/checkout/v1/payment',
    'request_target_inquiry'    => '/api/notify',
    'payment_due_date'          => 60,
    'client_id_dev'             => env('DOKU_CLIENT_KEY_ID_DEV', ''),
    'client_id_prod'            => env('DOKU_CLIENT_KEY_ID_PROD', ''),
    'secret_id_dev'             => env('DOKU_SECRET_KEY_ID_DEV', ''),
    'secret_id_prod'            => env('DOKU_SECRET_KEY_ID_PROD', ''),
    'callback_url'              => 'https://mirahproperty.com',
];
