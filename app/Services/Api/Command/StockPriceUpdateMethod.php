<?php

namespace App\Services\Api\Command;

use App\Models\Stock;
use GuzzleHttp\Client;

class StockPriceUpdateMethod
{
    public static function update()
    {
        try {
            $client = new Client();

            $stocks = Stock::query()
                ->get();

            foreach ($stocks as $stock){
                //Получение информации по тикеру акции
                $response = $client->get("https://iss.moex.com/iss/engines/stock/markets/shares/boards/tqbr/securities/".
                    "{$stock->ticker}.json".
                    "?securities.columns=SECID,SHORTNAME, PREVPRICE");//Get параметры, можно убрать первые два
                //Раскодирование
                $data = json_decode($response->getBody(), true);
                //Обновление цены
                $stock->update(['price' => $data['securities']['data'][0][2]]);
                $stock->refresh();
            }
        }
        catch (\Throwable $e){
                dd($e);
        }
    }
}
