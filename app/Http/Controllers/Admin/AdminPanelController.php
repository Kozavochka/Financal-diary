<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Telegram\Bot\Laravel\Facades\Telegram;




class AdminPanelController extends Controller
{
    public function index()
    {
        return view('admin.admin_panel');
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
