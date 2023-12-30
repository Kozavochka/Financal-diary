<?php

namespace App\Services\Statistic;

interface TotalStatisticServiceContract
{

    public function createStatistic();

    public function createItems();

    public function getSumInfo($direction);

    public function getCountInfo($direction);

    public function getAssetsInfo();

    public function calculate();

    public function getTotalPriceForSetting();

    public function setTotalPriceForSetting();
}
