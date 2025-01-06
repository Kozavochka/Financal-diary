<?php

namespace App\Http\Controllers\Admin\Statistic;

use App\Http\Controllers\Controller;
use App\Jobs\Export\Pdf\TotalStatisticPdfExportJob;
use App\Jobs\Statistic\CalculateDynamicStatisticJob;
use App\Models\TotalStatistic;
use App\Services\Chart\DataChartService;
use App\Services\Export\Pdf\AbstractPdfExportService;
use App\Services\Statistic\TotalStatisticServiceContract;
use Carbon\Carbon;

class StatisticController extends Controller
{
    protected $service;
    protected $chartSerive;

    private $pdfExportService;

    public function __construct(
        TotalStatisticServiceContract $service,
        DataChartService $chartSerive,
        AbstractPdfExportService $pdfExportService
    )
    {
        $this->service = $service;
        $this->chartSerive = $chartSerive;
        $this->pdfExportService = $pdfExportService;
    }

    public function index()
    {
        return view('admin.statistic.index');
    }

    public function dynamicStatistic()
    {
        $statistics = TotalStatistic::query()
            ->orderBy('created_at')
            ->paginate(10);

        return view('admin.statistic.dynamic', compact('statistics'));
    }
    public function createDynamicStatistic()
    {
        $statistic = TotalStatistic::query()
            ->orderByDesc('created_at')
            ->first();

        if ($statistic && Carbon::now()->diffInDays($statistic->created_at) < 1){
            return back()->withError("Период записи меньше суток")->withInput();
        }

        CalculateDynamicStatisticJob::dispatch(auth()->user()->id);

        return redirect()->back();
    }

    /**
     * Total statistic pie diagram
     */
    public function totalStatistic()
    {
        $dataArray = $this->chartSerive
            ->getChartData();

        $dataChart = $dataArray['dataChart'];
        $data = $dataArray['assetsData'];

        return view('admin.statistic.total', compact('dataChart',  'data'));
    }

    /**
     * Asset statistic bar diagram
     */
    public function assetsStatistic()
    {
        $assetsDataCollection = $this->chartSerive->getAssetStatisticData();

        $isPdfExportExist = $this->pdfExportService
            ->checkExport();

        return view(
            'admin.statistic.assets',
            compact('assetsDataCollection', 'isPdfExportExist')
        );
    }

    public function exportTotalPdf()
    {
        TotalStatisticPdfExportJob::dispatch();

        return redirect()->back();
    }

    public function downloadTotalPdfExport()
    {
        return $this->pdfExportService->downloadExport();
    }
}
