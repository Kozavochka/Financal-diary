<?php

namespace App\Services\Export\Pdf\Stock;


use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class StockPdfExportService
{
    const FILE_NAME = 'stock_export_pdf';

    const STORAGE_DIRECTORY_NAME = 'export/stock/';
    private Pdf $pdf;
    public function __construct()
    {
        $this->pdf = new Pdf();
    }

    public function export()
    {
        $pdf = Pdf::loadView('welcome');

        Storage::put(self::STORAGE_DIRECTORY_NAME . self::FILE_NAME . '.pdf', $pdf->output());
    }

}
