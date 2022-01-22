<?php

namespace Timedoor\Doku;

use DOKU\Client;
use Illuminate\Support\Facades\Log;

/**
 * 
 */
trait DokuTrait
{
    private function getClientID()
    {
        $configKey = $this->isProduction()
            ? 'doku.client_id_prod'
            : 'doku.client_id_dev';

        return config($configKey);
    }

    private function getSecretID()
    {
        $configKey = $this->isProduction()
            ? 'doku.secret_id_prod'
            : 'doku.secret_id_dev';

        return config($configKey);
    }

    private function getEndPointAPI()
    {
        return $this->isProduction()
            ? config('doku.api_endpoint_sandbox_prod')
            : config('doku.api_endpoint_sandbox_dev');
    }

    private function isProduction()
    {
        // Log::info(env('APP_ENV'));
        return env('APP_ENV') == 'production';
    }
}
