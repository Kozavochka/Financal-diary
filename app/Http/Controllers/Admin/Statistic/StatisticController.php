<?php

namespace App\Http\Controllers\Admin\Statistic;

use App\Http\Controllers\Controller;
use App\Models\TotalStatistic;
use App\Services\Statistic\TotalStatisticServiceContract;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    protected $service;

    public function __construct(TotalStatisticServiceContract $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $statistics = TotalStatistic::query()->get();
//        dd($statistics);
        return view('admin.statistic.index', compact('statistics'));
    }

    public function create()
    {
        //todo получение последней статистики и проверка времени
        $this->service->calculate();

        return view('admin.statistic.wait');
    }
}
