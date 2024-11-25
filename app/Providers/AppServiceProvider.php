<?php

namespace App\Providers;

use App\Services\Assets\AssetsService;
use App\Services\Assets\AssetsServiceContract;
use App\Services\Chart\DataChartService;
use App\Services\Chart\DataChartServiceContract;
use App\Services\Integrations\ByBit\ByBitIntegrationService;
use App\Services\Integrations\ByBit\ByBitIntegrationServiceContract;
use App\Services\Integrations\Frontiers\FrontiersIntegrationService;
use App\Services\Integrations\Frontiers\FrontiersIntegrationServiceContract;
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
        $this->app->singleton(AssetsServiceContract::class, AssetsService::class);
        $this->app->singleton(FrontiersIntegrationServiceContract::class, FrontiersIntegrationService::class);
        $this->app->singleton(ByBitIntegrationServiceContract::class, ByBitIntegrationService::class);


        Relation::enforceMorphMap([
            'income' => 'App\Models\Income',
        ]);
    }
}
