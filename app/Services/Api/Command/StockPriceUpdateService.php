<?php

namespace App\Services\Api\Command;

use App\Models\Assets\Stock;
use App\Services\Integrations\MOEX\MoexIntegrationService;
use GuzzleHttp\Client;

/**
 * Класс обновления стоимости акций
 */

class StockPriceUpdateService
{
    public function update()
    {
        try {
            $stocks = Stock::query()
                ->get();

            /** @var MoexIntegrationService $moexService */
            $moexService = resolve(MoexIntegrationService::class);

            /** @var Stock $stock */
            foreach ($stocks as $stock){
                $price = $moexService->getStockPrice($stock->ticker);
                //Обновление цены
                $stock->update(
                    [
                        'price' => $price,
                        'total_price' => bcmul($stock->lots , $price,2)
                    ]
                );
            }
        }
        catch (\Throwable $e){
                throw $e;
        }
    }
}
