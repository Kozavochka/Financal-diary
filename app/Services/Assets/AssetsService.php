<?php

namespace App\Services\Assets;

use App\Models\Assets\Bond;
use App\Models\Assets\Crypto;
use App\Models\Assets\Deposit;
use App\Models\Assets\Fund;
use App\Models\Assets\Loan;
use App\Models\Assets\Stock;
use App\Models\Settings;
use App\Services\Settings\SettingsHelper;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Spatie\QueryBuilder\QueryBuilder;

class AssetsService implements AssetsServiceContract
{
    const CHUNK_SIZE = 20;

    public function getAssetsWithPriceCollection(): Collection
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

    public function getDirectionsWithTotalPrice(): array
    {
        $usdPrice =  SettingsHelper::getUSDPriceFromSetting();

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

    public function getAssetsTotalPrice(): float
    {
        $directionsWithPrice = $this
            ->getDirectionsWithTotalPrice();

        return round(array_sum(Arr::flatten($directionsWithPrice)), 2);
    }
}
