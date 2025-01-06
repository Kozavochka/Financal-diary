<?php

namespace App\Services\Export\Pdf\Statistic;


use App\Models\Assets\Bond;
use App\Models\Assets\Crypto;
use App\Models\Assets\Deposit;
use App\Models\Assets\Fund;
use App\Models\Assets\Loan;
use App\Models\Assets\Stock;
use App\Models\Cash;
use App\Models\Industry;
use App\Services\Api\Finance\PriceCurrencyHelper;
use App\Services\DTO\Assets\BondDTO;
use App\Services\DTO\Assets\CryptoDTO;
use App\Services\DTO\Assets\DepositDTO;
use App\Services\DTO\Assets\FundDTO;
use App\Services\DTO\Assets\LoanDTO;
use App\Services\DTO\Assets\StockDTO;
use App\Services\Export\Pdf\AbstractPdfExportService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class StatisticAssetPdfExportService extends AbstractPdfExportService
{
    const FILE_NAME = 'total_export_pdf';

    const SUB_DIRECTORY = 'total/';

    public function export(): void
    {
        Storage::deleteDirectory(self::STORAGE_DIRECTORY_NAME . self::SUB_DIRECTORY);

        $this->exportData();
    }

    protected function getFilePath(): string
    {
        return self::STORAGE_DIRECTORY_NAME . self::SUB_DIRECTORY. self::FILE_NAME . '.pdf';
    }

    private function exportData()
    {
        $data = $this->getData();

        $dataSum = $this->getDataSum($data);
        $total = $this->getTotal($dataSum);
        $industries = $this->getIndustries();
        $cashSum = Cash::query()->sum('sum');

        Storage::put($this->getFilePath(), $this->pdf::loadView(
            'pdf.general_pdf',
            compact('data','dataSum', 'total', 'industries','cashSum')
        )
            ->output());

    }


    public function getData()
    {
        $data = collect();
        $assetData = collect();

        Stock::query()
            ->chunkById(self::CHUNK_SIZE, function (Collection $stocks) use (&$assetData) {
                foreach ($stocks as $stock) {
                    $assetData->push(
                      new StockDTO($stock)
                    );
                }
            });
        $data->put('stocks', $assetData);
        $assetData = collect();

        Bond::query()
            ->chunkById(self::CHUNK_SIZE, function (Collection $bonds) use (&$assetData) {
                foreach ($bonds as $bond) {
                    $assetData->push(
                        new BondDTO($bond)
                    );
                }
            });
        $data->put('bonds', $assetData);
        $assetData = collect();


        Crypto::query()
            ->chunkById(self::CHUNK_SIZE, function (Collection $cryptos) use (&$assetData) {
                foreach ($cryptos as $crypto) {
                    $assetData->push(
                        new CryptoDTO($crypto)
                    );
                }
            });
        $data->put('crypto', $assetData);
        $assetData = collect();

        Loan::query()
            ->with('company')
            ->chunkById(self::CHUNK_SIZE, function (Collection $loans) use (&$assetData) {
                foreach ($loans as $loan) {
                    $assetData->push(
                        new LoanDTO($loan)
                    );
                }
            });
        $data->put('loans', $assetData);
        $assetData = collect();

        Fund::query()
            ->chunkById(self::CHUNK_SIZE, function (Collection $funds) use (&$assetData) {
                foreach ($funds as $fund) {
                    $assetData->push(
                        new FundDTO($fund)
                    );
                }
            });
        $data->put('funds', $assetData);
        $assetData = collect();

        Deposit::query()
            ->with('bank')
            ->chunkById(self::CHUNK_SIZE, function (Collection $deposits) use (&$assetData) {
                foreach ($deposits as $deposit) {
                    $assetData->push(
                        new DepositDTO($deposit)
                    );
                }
            });
        $data->put('deposits', $assetData);
        $assetData = collect();


        return $data;
    }

    public function getDataSum(Collection $data)
    {
        return [
            'Акции' => $data->get('stocks')->sum(function (StockDTO $stockDTO) {
                return $stockDTO->getStockTotalPrice();
            }),

            'Облигации' => $data->get('bonds')->sum(function (BondDTO $assetDTO) {
                return $assetDTO->getTotalPrice();
            }),

            'Криптовалюта' => $data->get('crypto')->sum(function (CryptoDTO $assetDTO) {
                    return $assetDTO->getTotalPrice();
                }) * PriceCurrencyHelper::getUSDPrice(),

            'Займы' => $data->get('loans')->sum(function (LoanDTO $assetDTO) {
                return $assetDTO->getPrice();
            }),

            'Фонды' => $data->get('funds')->sum(function (FundDTO $assetDTO) {
                return $assetDTO->getTotalPrice();
            }),

            'Вклады' => $data->get('deposits')->sum(function (DepositDTO $assetDTO) {
                return $assetDTO->getPrice();
            })

        ];
    }

    public function getIndustries()
    {
        return Industry::query()
            ->withCount('stocks')
            ->get();
    }

    public function getTotal($dataSum)
    {
        //Получение общей стоимости
        return array_sum($dataSum);
    }
}
