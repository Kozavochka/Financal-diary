<?php

namespace App\Services\Integrations\MOEX;

use GuzzleHttp\Client;
use Illuminate\Support\Arr;

class MoexIntegrationService implements MoexIntegrationServiceContract
{
    private string $url;

    private Client $client;

    private const USD_LAST_PRICE_KEY = 'CBRF_USD_LAST';

    private const PREVPRICE_KEY = 'PREVPRICE';

    private const STOCK_LAST_PRICE_KEY = 'LAST';

    public function __construct()
    {
        $this->url = config('services.integrations.moex.url');

        $this->client = new Client();
    }

    public function getUsdLastPrice(): float
    {
        $response = $this->client->get(
            $this->url .
            "statistics/engines/currency/markets/selt/rates.json?iss.meta=off"
        );

        $data = json_decode($response->getBody(), true);

        $usdLastKeyIndex = array_search(self::USD_LAST_PRICE_KEY, $data['cbrf']['columns']);

        return round(Arr::first($data['cbrf']['data'])[$usdLastKeyIndex], 2);
    }

    public function getStockPrice(string $ticker): float
    {
        $response = $this->client->get(
            $this->url .
           "engines/stock/markets/shares/boards/tqbr/securities/".
            $ticker.".json".
            "?securities.columns=".self::PREVPRICE_KEY
        );

        $data = json_decode($response->getBody(), true);


        $lastPriceKeyIndex = array_search(self::STOCK_LAST_PRICE_KEY, $data['marketdata']['columns']);

        return round(Arr::first($data['marketdata']['data'])[$lastPriceKeyIndex], 2);
    }
}
