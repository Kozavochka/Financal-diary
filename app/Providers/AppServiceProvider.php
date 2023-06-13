<?php

namespace App\Providers;

use App\Services\Telegram\Contracts\TelegramBotServiceContract;
use App\Services\Telegram\TelegramBotService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(TelegramBotServiceContract::class, TelegramBotService::class);
    }
}
