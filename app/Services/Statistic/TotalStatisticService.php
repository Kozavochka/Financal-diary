<?php

namespace App\Services\Statistic;

use App\Models\Direction;
use App\Models\Settings;
use App\Models\TotalStatistic;
use App\Models\TotalStatisticItem;
use App\Services\Api\Finance\PriceCurrencyHelper;

class TotalStatisticService implements TotalStatisticServiceContract
{
    protected $statistic;

    protected $directions;

    protected $totalSum = 0;

    protected $usdPrice = 90;
    /**
     * Создание модельки статистики
     */
    public function createStatistic()
    {
       $this->statistic = TotalStatistic::query()->create();

       return $this;
    }

    /**
     * Создание item'а статистики
     * @return void
     */
    public function createItems()
    {
        foreach ($this->directions as $direction){
            TotalStatisticItem::query()
                ->create([
                    'total_statistic_id' => $this->statistic->id,
                    'direction_id' => $direction->id,
                    'sum' =>   $this->getSumInfo($direction),
                    'count' =>   $this->getCountInfo($direction),
                ]);
            $this->totalSum = bcadd($this->totalSum,$this->getSumInfo($direction),2);
        }
    }

    /**
     * Получение информации о сумме активов направления
     * @param $direction
     * @return int
     */
    public function getSumInfo($direction)//todo refactoring
    {
        if ($direction->stocks_sum_total_price != 0) return $direction->stocks_sum_total_price;

        if ($direction->bonds_sum_price != 0) return $direction->bonds_sum_price;

        if ($direction->funds_sum_price != 0) return $direction->funds_sum_price;

        if ($direction->cryptos_sum_price != 0) return $direction->cryptos_sum_price * $this->usdPrice;

        if ($direction->loans_sum_price != 0) return $direction->loans_sum_price;

        return 0;

    }

    /**
     * Получение информации о количестве активов направления
     * @param $direction
     * @return int
     */
    public function getCountInfo($direction)//todo refactoring
    {
        if ($direction->stocks_count != 0) return $direction->stocks_count;

        if ($direction->bonds_count != 0) return $direction->bonds_count;

        if ($direction->funds_count != 0) return $direction->funds_count;

        if ($direction->cryptos_count != 0) return $direction->cryptos_count;

        if ($direction->loans_count != 0) return $direction->loans_count;

        return 0;
    }

    /**
     * Получение направлений
     * @return $this
     */
    public function getAssetsInfo()//todo refactoring
    {
        $this->directions = Direction::query()
            ->withCount(['stocks','bonds','funds','cryptos','loans'])
            ->withSum('stocks','total_price')
            ->withSum('bonds','price')
            ->withSum('funds','price')
            ->withSum('cryptos','price')
            ->withSum('loans','price')
            ->get();

        return $this;
    }

    /**
     * Расчёт статистики
     * @return void
     */
    public function calculate()
    {
        $this->usdPrice =  PriceCurrencyHelper::getUSDPrice();

        $this->totalSum = 0;

        $this
            ->createStatistic()
            ->getAssetsInfo()
            ->createItems();

        $this->setTotalPriceForSetting();

        $this->statistic->total_sum = $this->totalSum;
        $this->statistic->save();
    }

    /**
     * Расчёт общей суммы для заполнения настройки
     * @return double
     */
    public function getTotalPriceForSetting()
    {
        $this->usdPrice =  PriceCurrencyHelper::getUSDPrice();

        $this->totalSum = 0;

        $this->getAssetsInfo();

        foreach ($this->directions as $direction){
            $this->totalSum = bcadd($this->totalSum,$this->getSumInfo($direction),2);
        }
        if ($this->totalSum == 0 ) return 1;// для обработки деления на ноль

        return $this->totalSum;
    }
    /**
     * Обновление общей суммы в настройке после расчёта статистики
     * @return $this
     */
    public function setTotalPriceForSetting()
    {
        Settings::query()
            ->where('key','total_price')
            ->update([
                'value' => ['price' => $this->totalSum]
            ]);

        return $this;
    }
}
