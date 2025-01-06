<?php

namespace App\Jobs\Export\Pdf;

use App\Services\Export\Pdf\Bond\BondPdfExportService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class BondPdfExportJob implements ShouldQueue
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
        /** @var BondPdfExportService $stockPdfExportService */
        $stockPdfExportService = resolve(BondPdfExportService::class);

        $stockPdfExportService->export();
    }

    /**
     * Get the tags that should be assigned to the job.
     *
     * @return array<int, string>
     */
    public function tags(): array
    {
        return ['export', 'pdf', 'bond_export'];
    }
}
