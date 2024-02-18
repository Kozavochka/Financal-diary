<?php

namespace App\Services\Api\Finance;

use GuzzleHttp\Client;

class PriceCurrencyHelper
{
    public static function getUSDPrice(){
        $client = new Client();

        $response = $client->get(env('MOEX_API_URL')
            ."statistics/engines/currency/markets/selt/rates.json?iss.meta=off",['verify' => false]);
        $data = json_decode($response->getBody(), true);

        return $data['cbrf']['data'][0][3];//"CBRF_USD_LAST",
    }
}
