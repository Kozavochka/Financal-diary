<?php

namespace App\Telegram\Commands;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Laravel\Facades\Telegram;
class ResetPasswordCommand extends Command
{
    protected string $name = 'reset';
    protected string $description = 'Сброс пароля';

     protected int $code;

    public function handle()
    {   //Получение id чата
        $chat_id = $this->getUpdate()->getMessage()->getChat()->getId();
        //Генерация кода
        $resetCode = $this->generateCode()->getCode();
        //Сохранение пароля в БД в зашифрованном виде
        User::query()
            ->where('chat_id', $chat_id)
            ->update([
                'reset_code' => Hash::make($resetCode)
            ]);
        //Отправка сообщения этому пользователю
        Telegram::bot('worker')->sendMessage([
            'chat_id' => $chat_id,
            'text' => 'Код для сброса пароля: '.$resetCode,
        ]);
    }

    public function generateCode()
    {
        $this->code = rand(10000,99999);
        return $this;
    }

    public function getCode()
    {
        return $this->code;
    }
}
