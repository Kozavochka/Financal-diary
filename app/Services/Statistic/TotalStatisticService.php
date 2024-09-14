<?php

namespace App\Services\Statistic;

use App\Models\Settings;
use App\Models\TotalStatistic;
use App\Services\Api\Finance\PriceCurrencyHelper;
use App\Services\Assets\AssetsServiceContract;
use Illuminate\Support\Facades\Cache;

class TotalStatisticService implements TotalStatisticServiceContract
{
    protected $statistic;

    protected $directions;

    protected $totalSum = 0;

    protected $usdPrice = 90;

    private $assetsService;
    public function __construct(
        AssetsServiceContract $assetsService
    )
    {
        $this->assetsService = $assetsService;
    }

    /**
     * Create statistic model
     */
    public function createStatistic()
    {
       $this->statistic = TotalStatistic::query()->create();

       return $this;
    }

    /**
     * Set total sum calculated by directions
     * @return $this
     */
    public function setTotalSum()
    {
        $this->totalSum = $this->assetsService->getAssetsTotalPrice();

        return $this;
    }

    /**
     * Расчёт статистики
     * @return void
     */
    public function calculate()
    {
        $this->usdPrice = PriceCurrencyHelper::getUSDPrice();

        $this->totalSum = 0;

        $this
            ->createStatistic()
            ->setTotalSum();

        $this->setTotalPriceForSetting();

        $this->statistic->total_sum = $this->totalSum;
        $this->statistic->save();
    }

    /**
     * Update USD price setting
     * @return $this
     */
    public function setTotalPriceForSetting()
    {
        Cache::delete('total_price');

        Settings::query()
            ->where('key','total_price')
            ->update([
                'value' => ['price' => $this->totalSum]
            ]);

        return $this;
    }
}
