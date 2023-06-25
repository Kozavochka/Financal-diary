<?php

namespace App\Telegram\Commands;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Laravel\Facades\Telegram;
class ResetPasswordCommand extends Command
{
    protected string $name = 'reset';
    protected string $description = 'Сброс пароля';

     protected int $code;

    public function handle()
    {
        $resetCode = $this->generateCode()->getCode();

        Cache::put('reset_code', $resetCode, $minutes = 10);

        $this->replyWithMessage([
            'text' => 'Код для сброса пароля: '.$resetCode,
        ]);
    }

    public function generateCode()
    {
        $this->code =rand(10000,99999);
        return $this;
    }

    public function getCode()
    {
        return $this->code;
    }
}
