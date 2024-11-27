<?php

namespace App\Services\Integrations\Akphavantage;

use GuzzleHttp\Client;

class AlphavantageIntegrationService implements AplhavantageIntegrationServiceContract
{

    private Client $client;

    private string $url;

    private string $key;

    public function __construct()
    {
        $this->client = new Client();

        $this->key = config('services.integrations.alphavantage.key');
        $this->url = config('services.integrations.alphavantage.url');
    }
    public function getCryptoPrice(string $ticker): float|string
    {
        $response = $this->client->get(
            $this->url. "query?" . "function=CURRENCY_EXCHANGE_RATE".
            "&from_currency={$ticker}&".
            "to_currency=USD&".
            "apikey={$this->key}"
        );

        $data = json_decode($response->getBody(), true);

        return $data['Realtime Currency Exchange Rate']['5. Exchange Rate'] ?? '';
    }
}
