<?php

namespace App\Services\Chart;

use App\Models\Assets\Bond;
use App\Models\Assets\Crypto;
use App\Models\Assets\Deposit;
use App\Models\Assets\Fund;
use App\Models\Assets\Loan;
use App\Models\Assets\Stock;
use App\Models\Settings;
use App\Services\Assets\AssetsServiceContract;
use Illuminate\Support\Arr;

class DataChartService implements DataChartServiceContract
{
    private $assetsService;
    public function __construct(AssetsServiceContract $assetsService)
    {
            $this->assetsService = $assetsService;
    }

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
        return $this->assetsService
            ->getDirectionsWithTotalPrice();
    }


    public function getAssetStatisticData()
    {
        return $this->assetsService
            ->getAssetsWithPriceCollection();
    }
}
