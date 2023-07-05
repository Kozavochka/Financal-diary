<?php

namespace App\Services\PDF;

use App\Models\Bond;
use App\Models\Crypto;
use App\Models\Fund;
use App\Models\Industry;
use App\Models\Loan;
use App\Models\Stock;
use Dompdf\Dompdf;
use Dompdf\Options;
use http\Env;
use Spatie\QueryBuilder\QueryBuilder;

class PdfExportAll
{

    public static function export()
    {
        //Данные для pdf файла
        $stocks_builder =QueryBuilder::for(Stock::class);//????

        $industries = Industry::query()
            ->withCount('stocks')
            ->get();

        //Получение записей
        $data = [
          'stocks' => $stocks_builder
              ->with('industry')
//              ->select('name', 'ticker', 'price', 'lots')
              ->get(),
          'bonds' => Bond::query()
              ->select('name', 'price', 'ticker', 'coupon', 'profit_percent', 'expiration_date')
              ->get(),
          'crypto' => Crypto::query()
              ->select('name', 'ticker', 'price')
              ->get(),
          'loans' => Loan::query()
              ->select('name', 'price', 'count_bus')
              ->get(),
          'funds' => Fund::query()
              ->select('name', 'ticker', 'price')
              ->get(),
        ];
        //Получение сумм
        $data_sum = [
            'Акции' =>$stocks_builder
                ->selectRaw('SUM(price * lots) as total')
                ->value('total'),

            'Облигации' => $data['bonds']->sum('price'),

            'Крипта' => $data['crypto']->sum('price') * 90,

            'Займы' => $data['loans']->sum('price'),

            'Фонды' => $data['funds']->sum('price'),

        ];

        //Получение общей стоимости
        $total = array_sum($data_sum);

        //Настройки pdf файла
        $options = new Options();
        $options->setChroot(public_path('css/pdf'));//Доступ к папке с css

        $pdf = new Dompdf($options);

        $pdf->set_base_path( public_path('css/pdf') );//Где искать css файлы

        $pdf->loadHtml(view('pdf.general_pdf', compact('data','data_sum', 'total', 'industries')),
            'UTF-8');
        $pdf->setPaper('A4', 'portrait');
        $pdf->render();
        $pdf->stream('Отчёт.pdf');
    }
}
