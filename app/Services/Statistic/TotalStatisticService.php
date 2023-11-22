<?php

namespace App\Services\Statistic;

use App\Models\Direction;
use App\Models\TotalStatistic;
use App\Models\TotalStatisticItem;
use Illuminate\Database\Eloquent\Builder;

class TotalStatisticService implements TotalStatisticServiceContract
{
    protected $statistic;

    protected $directions;

    protected $totalSum = 0;
    /**
     * Проверка периода даты
     */
    public function checkAvailableDate()
    {

    }

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
        if ($direction->stocks_sum_price != 0) return $direction->stocks_sum_price;

        if ($direction->bonds_sum_price != 0) return $direction->bonds_sum_price;

        if ($direction->funds_sum_price != 0) return $direction->funds_sum_price;

        if ($direction->cryptos_sum_price != 0) return $direction->cryptos_sum_price;

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
            ->withSum('stocks','price')//todo рефакторинг, нужно получить price_lots
            ->withSum('bonds','price')
            ->withSum('funds','price')
            ->withSum('cryptos','price')
            ->withSum('loans','price')
            ->get();
        dd($this->directions);
        return $this;
    }

    /**
     * Расчёт статистики
     * @return void
     */
    public function calculate()
    {
        $this->checkAvailableDate();

        $this->totalSum = 0;

        $this
            ->createStatistic()
            ->getAssetsInfo()
            ->createItems();

        $this->statistic->total_sum = $this->totalSum;
        $this->statistic->save();
        dd($this->statistic);
    }
}
