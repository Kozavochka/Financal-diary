<?php

namespace App\Http\Controllers\Admin\Statistic;

use App\Http\Controllers\Controller;
use App\Models\TotalStatistic;
use App\Services\Chart\DataChartService;
use App\Services\Statistic\TotalStatisticServiceContract;
use Carbon\Carbon;
class StatisticController extends Controller
{
    protected $service;
    protected $chartSerive;
    public function __construct(TotalStatisticServiceContract $service, DataChartService $chartSerive)
    {
        $this->service = $service;
        $this->chartSerive = $chartSerive;
    }

    public function index()
    {
        return view('admin.statistic.index');
    }

    public function dynamicStatistic()
    {
        $statistics = TotalStatistic::query()->paginate(10);

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
        $this->service->calculate();

        return view('admin.statistic.wait');
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

        return view(
            'admin.statistic.assets',
            compact('assetsDataCollection')
        );
    }
}
