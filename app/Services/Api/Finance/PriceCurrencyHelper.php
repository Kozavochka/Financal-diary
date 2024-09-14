<?php

namespace App\Services\Api\Finance;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;

class PriceCurrencyHelper
{
    const CACHE_TTL = 60 * 60;

    public static function getUSDPrice()
    {
        return Cache::tags(['currency','usd'])
            ->remember('usd_price', self::CACHE_TTL,  function() {
                $client = new Client();
                $response = $client->get(env('MOEX_API_URL')
                    ."statistics/engines/currency/markets/selt/rates.json?iss.meta=off");
                $data = json_decode($response->getBody(), true);

                return round($data['cbrf']['data'][0][3], 2);//"CBRF_USD_LAST",
            });

    }
}
