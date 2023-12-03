<?php

namespace App\Http\Controllers\Admin\Statistic;

use App\Exceptions\StatisticCreateTimeLessThanWeek;
use App\Http\Controllers\Controller;
use App\Models\TotalStatistic;
use App\Services\Statistic\TotalStatisticServiceContract;
use Carbon\Carbon;
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
        $statistics = TotalStatistic::query()->paginate(10);

        return view('admin.statistic.index', compact('statistics'));
    }

    public function create()
    {
        $statistic = TotalStatistic::query()->first();

        if ($statistic && Carbon::now()->diffInWeeks($statistic->created_at) < 1){
            return back()->withError("Период записи меньше недели")->withInput();
        }
        $this->service->calculate();

        return view('admin.statistic.wait');
    }
}
