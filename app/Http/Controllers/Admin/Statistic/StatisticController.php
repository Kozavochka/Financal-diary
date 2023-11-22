<?php

namespace App\Http\Controllers\Admin\Statistic;

use App\Http\Controllers\Controller;
use App\Models\TotalStatistic;
use Illuminate\Http\Request;

class StatisticController extends Controller
{

    public function index()
    {
        $statistics = TotalStatistic::query()->get();

        return view('admin.statistic.index', compact('statistics'));
    }

    public function create()
    {

    }
}
