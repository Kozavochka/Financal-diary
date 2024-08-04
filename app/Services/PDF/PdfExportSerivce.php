<?php

namespace App\Services\PDF;

use App\Models\Assets\Bond;
use App\Models\Assets\Crypto;
use App\Models\Assets\Fund;
use App\Models\Assets\Loan;
use App\Models\Assets\Stock;
use App\Models\Cash;
use App\Models\Industry;
use App\Models\Settings;
use Dompdf\Dompdf;
use Dompdf\Options;

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
        //Получение записей
        return [
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


    }

    public function getDataSum($data)
    {
        $usdPrice =  Settings::query()
            ->where('key','usd_price')
            ->first()->value['price'];

        return [
            'Акции' => Stock::query()
                ->selectRaw('SUM(price * lots) as total')
                ->value('total'),

            'Облигации' => $data['bonds']->sum('price'),

            'Крипта' => $data['crypto']->sum('price') * $usdPrice,

            'Займы' => $data['loans']->sum('price'),

            'Фонды' => $data['funds']->sum('price'),

        ];
    }

    public function getIndustries()
    {
        return Industry::query()
            ->withCount('stocks')
            ->get();
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

        $this->pdf->setPaper('A4');

        return $this;
    }

    public function loadHtml()
    {

        $data = $this->getData();
        $dataSum = $this->getDataSum($data);
        $total = $this->getTotal($dataSum);
        $industries = $this->getIndustries();
        $cashSum = Cash::query()->sum('sum');

        $this->pdf->loadHtml(view('pdf.general_pdf',
            compact('data','dataSum', 'total', 'industries','cashSum')),
            'UTF-8');

        return $this;
    }

    public function render()
    {
        $this->pdf->render();

        return $this;
    }

}
