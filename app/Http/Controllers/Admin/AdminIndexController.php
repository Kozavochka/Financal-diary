<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bond;
use App\Models\Crypto;
use App\Models\Direction;
use App\Models\Fund;
use App\Models\Loan;
use App\Models\Stock;
use Dflydev\DotAccessData\Data;
use Illuminate\Support\Facades\DB;
use Telegram\Bot\Laravel\Facades\Telegram;
use Telegram\Bot\Api;
class AdminIndexController extends Controller
{
    public function index()
    {
        /*ВЫНЕСТИ В ОТДЕЛЬНЫЙ МЕТОД*/
        $data = [
           'stocks' =>  DB::table('stocks')
               ->selectRaw('SUM(price * lots) as total')
               ->value('total'),

            'bonds' => Bond::query()->sum('price'),

            'crypto' => Crypto::query()->sum('price') * 80,

            'loans' => Loan::query()->sum('price'),

            'funds' => Fund::query()->sum('price'),
        ];

        $total = array_sum($data);

        $labels = array_keys($data);
        $newData = [];
        $i=0;
        //Как же это убого )0)
        foreach ($data as $key => $value) {
                $newData[$i] = $value;
                $i++;
        }
        return view('admin.admin_panel', compact('total', 'labels','newData', 'data'));
    }
}
