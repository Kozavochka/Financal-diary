<?php

namespace App\Providers;

use App\Telegram\Commands\StartCommand;
use Illuminate\Support\ServiceProvider;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Telegram::bot('worker')->addCommand(StartCommand::class);
    }
}
