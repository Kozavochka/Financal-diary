<?php

namespace App\Services\Chart;

use App\Models\Bond;
use App\Models\Crypto;
use App\Models\Deposit;
use App\Models\Fund;
use App\Models\Loan;
use App\Models\Settings;
use App\Services\Api\Finance\PriceCurrencyHelper;
use Illuminate\Support\Facades\DB;

class DataChartService implements DataChartServiceContract
{
    private $data = [];

    /**
     * Заполнение данных по активам
     * @return $this
     */
    public function setAssetsData()
    {
        $usdPrice =  Settings::query()
            ->where('key','usd_price')
            ->first()->value['price'];
        //Получение стоимости активов (актив => стоимость)
        $this->data = [
            'Акции' =>  DB::table('stocks')
                ->selectRaw('SUM(price * lots) as total')
                ->value('total'),

            'Облигации' => Bond::query()->sum('price'),

            'Крипта' => round(Crypto::query()->sum('price') * $usdPrice,2),

            'Займы' => Loan::query()->sum('price'),

            'Фонды' => Fund::query()->sum('price'),

            'Вклады' => Deposit::query()->sum('price'),
        ];
        return $this;
    }

    /**
     * Получение и возврат данных для графиков
     * @return array
     */
    public function getChartData()
    {
        $newData = [];//Массив значений стоимости (стоимость)

        foreach ($this->data as $key => $value) {
            $newData[] = $value;
        }

        $dataChart = [
            'labels' => array_keys($this->data),//Получение названий (актив),
            'numeric' => $newData,
            'total' =>  array_sum($this->data),//Расчёт общей стоимости
        ];

        $dataChart['total'] =  $dataChart['total'] == 0 ? 1:$dataChart['total'];

        return [
           'dataChart' => $dataChart,
            'data' =>$this->data
        ];
    }
}
