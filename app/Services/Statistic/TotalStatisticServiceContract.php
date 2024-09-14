<?php

namespace App\Services\Statistic;

interface TotalStatisticServiceContract
{
    public function createStatistic();

    public function setTotalSum();

    public function calculate();

    public function setTotalPriceForSetting();
}
