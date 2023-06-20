<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bond;
use App\Models\Crypto;
use App\Models\Direction;
use App\Models\Fund;
use App\Models\Loan;
use App\Models\Stock;
use App\Services\Admin\GetDataChart;
use Dflydev\DotAccessData\Data;
use Illuminate\Support\Facades\DB;
use Telegram\Bot\Laravel\Facades\Telegram;
use Telegram\Bot\Api;
class AdminIndexController extends Controller
{
    public function index()
    {
        //Получение стоимости активов (актив => стоимость)
        $data = [
           'stocks' =>  DB::table('stocks')
               ->selectRaw('SUM(price * lots) as total')
               ->value('total'),

            'bonds' => Bond::query()->sum('price'),

            'crypto' => Crypto::query()->sum('price') * 80,

            'loans' => Loan::query()->sum('price'),

            'funds' => Fund::query()->sum('price'),
        ];

        //Получение данных для графика и общей стоимости
        $dataChart = GetDataChart::get_data($data);


        return view('admin.admin_panel', compact('dataChart',  'data'));
    }
}
