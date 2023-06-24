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
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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


    public function telegram()
    {
        Telegram::bot('worker')->setWebhook([
           'url' => 'https://0a1f-46-73-165-51.ngrok-free.app/webhook',
        ]);
        Telegram::bot('worker')->addCommand(StartCommand::class);
        $response = Telegram::bot('worker')->getCommands();


     /*   $update = new \Telegram\Bot\Objects\Update([
            "update_id" => 123456789,
            "message" => [
                "message_id" => 1,
                "chat" => [
                    "id" => env('TELEGRAM_MY_CHAT_ID'),
                    "type" => "private",
                ],
                "date" => 1641297154,
                "text" => "/start",
                "entities" => [
                    [
                        "offset" => 0,
                        "length" => 6,
                        "type" => "bot_command",
                    ],
                ],
            ],
        ]);


       Telegram::bot('worker')->processCommand($update);*/

        dump($response);

        return 'OK123';
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
