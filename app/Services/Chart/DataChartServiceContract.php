<?php

namespace App\Services\Chart;

interface DataChartServiceContract
{
    const CHUNK_SIZE = 20;

    public function getChartData();

    public function getAssetStatisticData();

}
