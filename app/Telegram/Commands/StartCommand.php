<?php

namespace App\Telegram\Commands;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Laravel\Facades\Telegram;

class StartCommand extends Command
{
    protected string $name = 'start';
    protected string $description = 'Работай умаляю';

    public function handle()
    {   $chat_id = $this->getUpdate()->getMessage()->getChat()->getId();
        $text = "Привет! Ваш chat_id: " . $chat_id;
/*        $data = [
            'chat_id' => $chat_id,
            'text' => $text
        ];*/
        $this->replyWithMessage([
            'text' => 'Hey, there! Welcome to our bot!',
        ]);
//        Telegram::bot('worker')->sendMessage($data);
    }
}
