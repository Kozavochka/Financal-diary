<?php

namespace App\Telegram\Commands;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Laravel\Facades\Telegram;

class StartCommand extends Command
{
    protected string $name = 'start';
    protected string $description = 'Работай падлаааааааа';

    public function handle()
    {
       /* $this->replyWithMessage([
            'text' => 'Hey, there! Welcome to our bot!',
        ]);*/
        Telegram::bot('worker')->sendMessage([
            'chat_id' => env('TELEGRAM_MY_CHAT_ID'), // ID чата, куда отправлять уведомление
            'text' => 'Работай падла'// Текст уведомления
        ]);
    }
}
