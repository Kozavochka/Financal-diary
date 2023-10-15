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
use Spatie\QueryBuilder\QueryBuilder;

class PdfExportSerivce implements PdfExportServiceContract
{

    private $pdf;

    public function export()
    {

        $this->setPdfSettings();
        $this->render();

        $this->pdf->stream('Отчёт.pdf');
    }

    public function getData()
    {
        //TODO кэш
        //Получение записей
        $data = [
            'stocks' => Stock::query()
                ->with('industry')
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

        return $data;


    }

    public function getDataSum($data)
    {
       //TODO кэш
       $dataSum =  [

           'Акции' => Stock::query()
               ->selectRaw('SUM(price * lots) as total')
               ->value('total'),

           'Облигации' => $data['bonds']->sum('price'),

           'Крипта' => $data['crypto']->sum('price') * 90,

           'Займы' => $data['loans']->sum('price'),

           'Фонды' => $data['funds']->sum('price'),

       ];

       return $dataSum;
    }

    public function getIndustries()
    {
        //TODO кэш
        $industries = Industry::query()
            ->withCount('stocks')
            ->get();

        return $industries;
    }

    public function getTotal($dataSum)
    {
        //Получение общей стоимости
        return array_sum($dataSum);
    }

    public function setPdfSettings()
    {
        //Настройки pdf файла
        $options = new Options();
        $options->setChroot(public_path('css/pdf'));//Доступ к папке с css
        $options->setIsJavascriptEnabled(true);//подклчение js
        $options->setIsRemoteEnabled(true);//подключение библиотек по ссылкам

        $this->pdf = new Dompdf($options);
        $this->pdf->set_base_path(public_path('css/pdf'));//Где искать css файлы


        $this->loadHtml();

        $this->pdf->setPaper('A4', 'portrait');

        return $this;
    }

    public function loadHtml()
    {

        $data = $this->getData();
        $data_sum = $this->getDataSum($data);
        $total = $this->getTotal($data_sum);
        $industries = $this->getIndustries();

        $this->pdf->loadHtml(view('pdf.general_pdf', compact('data','data_sum', 'total', 'industries')),
            'UTF-8');

        return $this;
    }

    public function render()
    {
        $this->pdf->render();

        return $this;
    }

}