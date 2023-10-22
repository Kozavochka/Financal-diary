<?php

namespace App\Jobs;

use App\Models\Industry;
use App\Models\Stock;
use App\Services\PDF\PdfExportAll;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\QueryBuilder\QueryBuilder;

class ExportAllPdfProcess implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function handle()
    {
        PdfExportAll::export($this->data);
    }
}
