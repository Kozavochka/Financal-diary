<?php

namespace App\Services\Api\Command;

use App\Models\Assets\Crypto;
use GuzzleHttp\Client;

/**
 * Класс обновления стоимости криптоактивов
*/
class CryptoUpdateMethod implements UpdateAssetsPrice
{

    public function update()
    {

        $client = new Client();

        $cryptos = Crypto::query()
            ->get();

        $key = env('MY_ALPHAVANTAGE_API_KEY');
        foreach ($cryptos as $crypto){
            $response = $client->get(env('CRYPTO_API_URL')."query?".
                "function=CURRENCY_EXCHANGE_RATE".
                "&from_currency={$crypto->ticker}&".
                "to_currency=USD&".
                "apikey={$key}",['verify' => false]);

            $data = json_decode($response->getBody(), true);
            $cryptoPrice = $data['Realtime Currency Exchange Rate']['5. Exchange Rate'];

            $crypto->update(['price' => round($cryptoPrice, 3)]);
        }
    }

}
