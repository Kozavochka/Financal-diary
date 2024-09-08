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
     * Get data for total statistic
     * @return array
     */
    public function getChartData(): array
    {
        $assetsData = $this->getAssetsData();

        $dataChart = [
            'labels' => array_keys($assetsData),
            'numeric' => Arr::flatten($assetsData),
            'total' =>  array_sum($assetsData),
        ];

        $dataChart['total'] =  $dataChart['total'] == 0 ? 0:$dataChart['total'];

        return [
            'dataChart' => $dataChart,
            'assetsData' => $assetsData
        ];
    }
    /**
     * @return array
     */
    private function getAssetsData(): array
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


    public function getAssetStatisticData()
    {
        $assetStatisticCollect = collect();

        $assetStatisticCollect->put('stocks', $this->getStocksData());

        $assetStatisticCollect->put('cryptos', $this->getCryptosData());

        $assetStatisticCollect->put('bonds', $this->getBondsData());

        $assetStatisticCollect->put('funds', $this->getFundsData());

        $assetStatisticCollect->put('deposits', $this->getDepositsData());

        $assetStatisticCollect->put('loans', $this->getLoansData());

        return $assetStatisticCollect;
    }

    /**
     * Get all stocks data for assets statistic chart
     * @return Collection
     */
    public function getStocksData(): Collection
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

    private function getCryptosData(): Collection
    {
        $cryptoData = collect();

        Crypto::query()
            ->select(['name','price','lots'])
            ->orderByRaw('(lots*price) desc')
            ->chunk(self::CHUNK_SIZE, function (Collection $collection) use (&$cryptoData) {
                $cryptoData->push($collection);
            });

        return $cryptoData->flatten();
    }

    private function getBondsData(): Collection
    {
        $bondsData = collect();

        Bond::query()
            ->select(['name','price','lots'])
            ->orderByRaw('(lots*price) desc')
            ->chunk(self::CHUNK_SIZE, function (Collection $collection) use (&$bondsData) {
                $bondsData->push($collection);
            });

        return $bondsData->flatten();
    }

    private function getFundsData(): Collection
    {
        $fundsData = collect();

        Fund::query()
            ->select(['name','price','lots'])
            ->orderByRaw('(lots*price) desc')
            ->chunk(self::CHUNK_SIZE, function (Collection $collection) use (&$fundsData) {
                $fundsData->push($collection);
            });

        return $fundsData->flatten();
    }

    private function getDepositsData(): Collection
    {
        $depositsData = collect();

        Deposit::query()
            ->with('bank')
            ->orderByRaw('(price) desc')
            ->chunk(self::CHUNK_SIZE, function (Collection $collection) use (&$depositsData) {
                $depositsData->push($collection);
            });

        return $depositsData->flatten();
    }

    private function getLoansData(): Collection
    {
        $loansData = collect();

        Loan::query()
            ->with('company')
            ->orderByRaw('(price) desc')
            ->chunk(self::CHUNK_SIZE, function (Collection $collection) use (&$loansData) {
                $loansData->push($collection);
            });

        return $loansData->flatten();
    }
}
