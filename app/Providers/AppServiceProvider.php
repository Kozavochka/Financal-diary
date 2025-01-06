<?php

namespace App\Providers;

use App\Http\Controllers\Admin\Assets\AdminBondController;
use App\Http\Controllers\Admin\Assets\AdminStockController;
use App\Services\Assets\AssetsService;
use App\Services\Assets\AssetsServiceContract;
use App\Services\Chart\DataChartService;
use App\Services\Chart\DataChartServiceContract;
use App\Services\Export\Pdf\AbstractPdfExportService;
use App\Services\Export\Pdf\Bond\BondPdfExportService;
use App\Services\Export\Pdf\PdfExportSerivce;
use App\Services\Export\Pdf\PdfExportServiceContract;
use App\Services\Export\Pdf\Stock\StockPdfExportService;
use App\Services\Integrations\Akphavantage\AlphavantageIntegrationService;
use App\Services\Integrations\Akphavantage\AplhavantageIntegrationServiceContract;
use App\Services\Integrations\ByBit\ByBitIntegrationService;
use App\Services\Integrations\ByBit\ByBitIntegrationServiceContract;
use App\Services\Integrations\Frontiers\FrontiersIntegrationService;
use App\Services\Integrations\Frontiers\FrontiersIntegrationServiceContract;
use App\Services\Integrations\MOEX\MoexIntegrationService;
use App\Services\Integrations\MOEX\MoexIntegrationServiceContract;
use App\Services\Statistic\TotalStatisticService;
use App\Services\Statistic\TotalStatisticServiceContract;
use App\Services\Telegram\Contracts\TelegramBotServiceContract;
use App\Services\Telegram\TelegramBotService;
use Illuminate\Database\Eloquent\Relations\Relation;
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
        $this->app->singleton(MoexIntegrationServiceContract::class, MoexIntegrationService::class);
        $this->app->singleton(AplhavantageIntegrationServiceContract::class, AlphavantageIntegrationService::class);

        $this->app->when(AdminStockController::class)
            ->needs(AbstractPdfExportService::class)
            ->give(StockPdfExportService::class);

        $this->app->when(AdminBondController::class)
            ->needs(AbstractPdfExportService::class)
            ->give(BondPdfExportService::class);

        Relation::enforceMorphMap([
            'income' => 'App\Models\Income',
        ]);
    }
}
