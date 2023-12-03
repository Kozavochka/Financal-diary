<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Chart\DataChartService;
use Telegram\Bot\Laravel\Facades\Telegram;




class AdminIndexController extends Controller
{
    private $chartSerive;

    public function __construct(DataChartService $service)
    {
        $this->chartSerive = $service;
    }
    public function index()
    {

        $dataArray = $this->chartSerive
            ->setAssetsData()
            ->getChartData();

        $dataChart = $dataArray['dataChart'];
        $data = $dataArray['data'];

        return view('admin.admin_panel', compact('dataChart',  'data'));
    }

    //Метод для обновления телеграмм бота
    public function setTG()
    {
        Telegram::bot('worker')->setWebhook([
            'url' => env('WORKER_WEBHOOK_URL'),
        ]);
//        Telegram::bot('worker')->addCommand(ResetPasswordCommand::class);
        $response = Telegram::bot('worker')->getWebhookInfo();

        dump($response);
        return 'Действие выполнено ';

    }
}
