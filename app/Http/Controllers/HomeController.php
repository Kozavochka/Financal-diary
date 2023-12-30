<?php

namespace App\Http\Controllers;

use App\Services\Chart\DataChartService;
use App\Services\PDF\PdfExportServiceContract;
use Illuminate\Support\Facades\Cache;


class HomeController extends Controller
{

    private $pdfSerice;
    private $chartSerive;
    public function __construct(PdfExportServiceContract $pdfServ, DataChartService $service)
    {
        $this->pdfSerice = $pdfServ;

        $this->chartSerive = $service;

        $this->middleware('auth');
    }


    public function index()
    {
        $dataArray = $this->chartSerive
            ->setAssetsData()
            ->getChartData();

        $dataChart = $dataArray['dataChart'];
        $data = $dataArray['data'];

        return view('home', compact('data', 'dataChart'));
    }

    public function pdf_export()
    {

        $this->pdfSerice->export();

    }
}
