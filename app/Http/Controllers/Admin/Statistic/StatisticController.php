<?php

namespace App\Http\Controllers\Admin\Statistic;

use App\Http\Controllers\Controller;
use App\Models\Bond;
use App\Models\Crypto;
use App\Models\Industry;
use App\Models\Stock;
use App\Models\TotalStatistic;
use App\Services\Chart\DataChartService;
use App\Services\Statistic\TotalStatisticServiceContract;
use Carbon\Carbon;
use Spatie\QueryBuilder\QueryBuilder;

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
        $statistic = TotalStatistic::query()->first();

        if ($statistic && Carbon::now()->diffInWeeks($statistic->created_at) < 1){
            return back()->withError("Период записи меньше недели")->withInput();
        }
        $this->service->calculate();

        return view('admin.statistic.wait');
    }
    public function totalStatistic()
    {
        $dataArray = $this->chartSerive
            ->setAssetsData()
            ->getChartData();

        $dataChart = $dataArray['dataChart'];
        $data = $dataArray['data'];

        return view('admin.statistic.total', compact('dataChart',  'data'));
    }

    public function assetsStatistic()
    {
        $stocks = QueryBuilder::for(Stock::class)
            ->orderByRaw('total_price desc')
            ->get();

        $crypto = Crypto::query()->get();

        $industries = Industry::query()
            ->withCount('stocks')
            ->withSum('stocks','total_price')
            ->get();

        $bonds = Bond::query()->get();

        return view(
            'admin.statistic.assets',
            compact('stocks','crypto','industries','bonds')
        );
    }
}
