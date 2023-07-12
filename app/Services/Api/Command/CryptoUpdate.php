<?php

namespace App\Services\Api\Command;

use App\Models\Crypto;
use GuzzleHttp\Client;
use PHPUnit\Exception;

class CryptoUpdate
{

    public static function update()
    {

        $client = new Client();

        $cryptos = Crypto::query()
            ->get();
        foreach ($cryptos as $crypto){
            $response = $client->get("https://www.alphavantage.co/query?".
                "function=CURRENCY_EXCHANGE_RATE".
                "&from_currency={$crypto->ticker}&".
                "to_currency=USD&".
                "apikey=DJSG6DBIPC2ERBII");
            $data = json_decode($response->getBody(), true);
            $cryptoPrice = $data['Realtime Currency Exchange Rate']['5. Exchange Rate'];
            /*     dump($crypto->ticker ,$cryptoPrice);*/
            $crypto->update(['price' => bcdiv($crypto->lots * $cryptoPrice,1,2)]);
        }
    }

}
