<?php

namespace App\Services\Api\Command;

use App\Models\Assets\Crypto;
use App\Services\Integrations\Akphavantage\AlphavantageIntegrationService;
use GuzzleHttp\Client;

/**
 * Класс обновления стоимости криптоактивов
*/
class CryptoPriceUpdateService
{

    public function update()
    {
        $cryptos = Crypto::query()
            ->get();

        /** @var AlphavantageIntegrationService  $cryptoService */
        $cryptoService = resolve(AlphavantageIntegrationService::class);

        /** @var Crypto $crypto */
        foreach ($cryptos as $crypto){

            $cryptoPrice = $cryptoService->getCryptoPrice($crypto->ticker);

            if (!empty($cryptoPrice)) {
                $crypto->update(['price' => round($cryptoPrice, 3)]);
            }
        }
    }

}
