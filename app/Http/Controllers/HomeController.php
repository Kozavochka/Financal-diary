<?php

namespace App\Http\Controllers;

use App\Services\Chart\DataChartService;


class HomeController extends Controller
{
    private $chartSerive;
    public function __construct(DataChartService $service)
    {
        $this->chartSerive = $service;

        $this->middleware('auth');
    }


    public function index()
    {
        $dataArray = $this->chartSerive
            ->getChartData();

        $dataChart = $dataArray['dataChart'];
        $data = $dataArray['assetsData'];

        return view('home', compact('data', 'dataChart'));
    }
}
