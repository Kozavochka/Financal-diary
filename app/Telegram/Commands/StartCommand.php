<?php

namespace App\Telegram\Commands;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Laravel\Facades\Telegram;

class StartCommand extends Command
{
    protected string $name = 'start';
    protected string $description = 'Стартовая команда';

    public function handle()
    {   $chat_id = $this->getUpdate()->getMessage()->getChat()->getId();
        $text = "Привет,этот телеграмм бот предназначен для дополнительной верификации аккаунта,а также рассылке новостей!
Ваш chat_id: " . $chat_id;

        //Eсли start не через сайт
        if(Cache::get('user_tg')) {
            User::query()
                ->where('id', Cache::get('user_tg'))
                ->update([
                    'chat_id' => $chat_id
                ]);
            Cache::forget('user_tg');
        }

        $this->replyWithMessage([
            'text' => $text,
        ]);
    }
}
