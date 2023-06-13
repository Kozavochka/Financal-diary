<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Direction;
use App\Models\Stock;
use Dflydev\DotAccessData\Data;
use Telegram\Bot\Laravel\Facades\Telegram;
use Telegram\Bot\Api;
class AdminIndexController extends Controller
{
    public function index()
    {
        /*$response = Telegram::getMe();
        Telegram::sendMessage([
            'chat_id' => '442395129', // ID чата, куда отправлять уведомление
            'text' => 'Привет, это уведомление от бота!' // Текст уведомления
        ]);
        dd($response);*/
        return view('admin.admin_panel');
    }
}
