<?php

namespace App\DokuUtil;

use DOKU\Client;

/**
 * 
 */
trait DokuTrait
{
    private function getClientID()
    {
        $envKey = $this->isProduction()
            ? 'DOKU_CLIENT_KEY_ID_PROD'
            : 'DOKU_CLIENT_KEY_ID_DEV';

        return env($envKey);
    }

    private function getSecretID()
    {
        $envKey = $this->isProduction()
            ? 'DOKU_SECRET_KEY_ID_PROD'
            : 'DOKU_SECRET_KEY_ID_DEV';

        return env($envKey);
    }

    private function getEndPointAPI()
    {

        return $this->isProduction()
            ? config('doku.api_endpoint_sandbox_prod')
            : config('doku.api_endpoint_sandbox_dev');
    }

    private function isProduction()
    {
        return env('APP_PRODUCTION') == true;
    }
}
