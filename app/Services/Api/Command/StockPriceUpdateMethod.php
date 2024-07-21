<?php

namespace App\Services\Api\Command;

use App\Models\Stock;
use GuzzleHttp\Client;

/**
 * Класс обновления стоимости акций
 */

class StockPriceUpdateMethod implements UpdateAssetsPrice
{
    public function update()
    {
        try {
            $client = new Client();

            $stocks = Stock::query()
                ->get();

            foreach ($stocks as $stock){
                //Получение информации по тикеру акции
                $response = $client->get(env('MOEX_API_URL')."engines/stock/markets/shares/boards/tqbr/securities/".
                    "{$stock->ticker}.json".
                    "?securities.columns=SECID,SHORTNAME, PREVPRICE",['verify' => false]);//Get параметры, можно убрать первые два
                //Раскодирование
                $data = json_decode($response->getBody(), true);
                //Обновление цены
                $stock->update(
                    [
                        'price' => $data['securities']['data'][0][2],
                        'total_price' => round($stock->lots * $data['securities']['data'][0][2],2)//todo
                    ]
                );
                $stock->refresh();
            }
        }
        catch (\Throwable $e){
                dd($e);
        }
    }
}
