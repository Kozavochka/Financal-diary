<?php

namespace App\Services\Chart;

use App\Models\Assets\Bond;
use App\Models\Assets\Crypto;
use App\Models\Assets\Deposit;
use App\Models\Assets\Fund;
use App\Models\Assets\Loan;
use App\Models\Assets\Stock;
use App\Models\Settings;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\QueryBuilder;

class DataChartService implements DataChartServiceContract
{
    /**
     * Заполнение данных по активам
     * @return array
     */
    public function getAssetsData(): array
    {
        $usdPrice =  Settings::query()
            ->where('key','usd_price')
            ->first()->value['price'];
        //Получение стоимости активов (актив => стоимость)
        return [
            'Акции' =>  Stock::query()
                ->selectRaw('SUM(price * lots) as total')
                ->value('total') ?? 0,

            'Облигации' => Bond::query()
                ->selectRaw('SUM(price * lots) as total')
                ->value('total') ?? 0,

            'Криптовалюта' => round(Crypto::query()
                    ->selectRaw('SUM(price * lots) as total')
                    ->value('total') * $usdPrice,2) ?? 0,

            'Займы' => Loan::query()->sum('price') ?? 0,

            'Фонды' => Fund::query()
                ->selectRaw('SUM(price * lots) as total')
                ->value('total') ?? 0,

            'Вклады' => Deposit::query()->sum('price') ?? 0,
        ];
    }

    /**
     * Получение и возврат данных для графиков
     * @return array
     */
    public function getChartData(): array
    {
        $assetsData = $this->getAssetsData();

        $dataChart = [
            'labels' => array_keys($assetsData),//Получение названий (актив),
            'numeric' => Arr::flatten($assetsData),
            'total' =>  array_sum($assetsData),//Расчёт общей стоимости
        ];

        $dataChart['total'] =  $dataChart['total'] == 0 ? 0:$dataChart['total'];

        return [
            'dataChart' => $dataChart,
            'assetsData' => $assetsData
        ];
    }

    /**
     * Get all stocks data for assets statistic chart
     * @return Collection|array
     */
    public function getStocksData(): Collection|array
    {
        $stocksData = collect();

        QueryBuilder::for(Stock::class)
            ->select(['name','price','lots'])
            ->orderByRaw('(lots*price) desc')
            ->chunk(self::CHUNK_SIZE, function (Collection $stocks) use (&$stocksData) {
                $stocksData->push($stocks);
            });

        return $stocksData->flatten();
    }

    public function getCryptoData()
    {
        return Crypto::query()
            ->get();
    }
}
