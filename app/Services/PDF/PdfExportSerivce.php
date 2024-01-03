<?php

namespace App\Services\PDF;

use App\Models\Bond;
use App\Models\Crypto;
use App\Models\Fund;
use App\Models\Industry;
use App\Models\Loan;
use App\Models\Settings;
use App\Models\Stock;
use App\Services\Api\Finance\PriceCurrencyHelper;
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

        $this->pdf->loadHtml(view('pdf.general_pdf', compact('data','dataSum', 'total', 'industries')),
            'UTF-8');

        return $this;
    }

    public function render()
    {
        $this->pdf->render();

        return $this;
    }

}
