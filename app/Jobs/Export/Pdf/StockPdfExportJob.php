<?php

namespace App\Jobs\Export\Pdf;

use App\Services\Export\Pdf\Stock\StockPdfExportService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StockPdfExportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        /** @var StockPdfExportService $stockPdfExportService */
        $stockPdfExportService = resolve(StockPdfExportService::class);

        $stockPdfExportService->export();
    }

    /**
     * Get the tags that should be assigned to the job.
     *
     * @return array<int, string>
     */
    public function tags(): array
    {
        return ['export', 'pdf', 'stock_export'];
    }
}
