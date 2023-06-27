<?php

namespace App\Http\Controllers;

use App\Events\ExportAllPdf;
use App\Models\Bond;
use App\Models\Crypto;
use App\Models\Fund;
use App\Models\Industry;
use App\Models\Loan;
use App\Models\Stock;
use App\Services\Admin\GetDataChart;
use App\Services\PDF\PdfExportAll;
use App\Telegram\Commands\StartCommand;
use Dompdf\Dompdf;
use http\Client\Curl\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use Telegram\Bot\Laravel\Facades\Telegram;
use Telegram\Bot\Methods\Update;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = [
            'Акции' => DB::table('stocks')
                ->selectRaw('SUM(price * lots) as total')
                ->value('total'),

            'Облигации' => Bond::query()->sum('price'),

            'Крипта' => Crypto::query()->sum('price') * 80,

            'Займы' => Loan::query()->sum('price'),

            'Фонды' => Fund::query()->sum('price'),
        ];


        //Получение данных для графика и общей стоимости
        $dataChart = GetDataChart::get_data($data);

        Cache::put('total',  $dataChart['total'], now()->addMinutes(10));

        return view('home', compact('data', 'dataChart'));
    }

    public function pdf_export()
    {
        $data = [
            'Акции' => DB::table('stocks')
                ->selectRaw('SUM(price * lots) as total')
                ->value('total'),

            'Облигации' => Bond::query()->sum('price'),

            'Крипта' => Crypto::query()->sum('price') * 80,

            'Займы' => Loan::query()->sum('price'),

            'Фонды' => Fund::query()->sum('price'),
        ];
        // Вынести в job так как долго загружается
        PdfExportAll::export($data);

//        event(new ExportAllPdf($data)); //Не предлагает скачиваться???

    }
}
