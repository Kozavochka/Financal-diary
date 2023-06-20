<?php

namespace App\Services\Admin;

use App\Models\Bond;
use App\Models\Crypto;
use App\Models\Fund;
use App\Models\Loan;
use Illuminate\Support\Facades\DB;

class GetDataChart
{
    //Получение данных для графиков и общей стоимости
    public static function get_data($data)
    {

        $newData = [];//Массив значений стоимости (стоимость)
        $i=0;
        foreach ($data as $key => $value) {
            $newData[$i] = $value;
            $i++;
        }

        $dataChart = [
          'labels' => array_keys($data),//Получение названий (актив),
          'numeric' => $newData,
          'total' =>  array_sum($data),//Расчёт общей стоимости
        ];

        return $dataChart;
    }
}
