<?php

namespace App\Providers;

use App\Services\Chart\DataChartService;
use App\Services\Chart\DataChartServiceContract;
use App\Services\PDF\PdfExportSerivce;
use App\Services\PDF\PdfExportServiceContract;
use App\Services\Statistic\TotalStatisticService;
use App\Services\Statistic\TotalStatisticServiceContract;
use App\Services\Telegram\Contracts\TelegramBotServiceContract;
use App\Services\Telegram\TelegramBotService;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;
use Telegram\Bot\Laravel\Facades\Telegram;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {


    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(TelegramBotServiceContract::class, TelegramBotService::class);
        $this->app->singleton(PdfExportServiceContract::class, PdfExportSerivce::class);
        $this->app->singleton(TotalStatisticServiceContract::class, TotalStatisticService::class);
        $this->app->singleton(DataChartServiceContract::class, DataChartService::class);


        Relation::enforceMorphMap([
            'income' => 'App\Models\Income',
        ]);
    }
}
