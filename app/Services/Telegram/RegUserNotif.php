<?php

namespace App\Services\Telegram;

use Telegram\Bot\Laravel\Facades\Telegram;

class RegUserNotif
{
    public static function sendMessage(array $data)
    {
        Telegram::sendMessage([
            'chat_id' => env('TELEGRAM_MY_CHAT_ID'), // ID чата, куда отправлять уведомление
            'text' => 'Новый пользователь зарегистрирован: '.$data['name'].' '.$data['email'] // Текст уведомления
        ]);

    }
}
