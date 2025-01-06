<?php

namespace App\Services\Export\Pdf\Stock;


use App\Services\Export\Pdf\AbstractPdfExportService;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class StockPdfExportService extends AbstractPdfExportService
{
    const FILE_NAME = 'stock_export_pdf';

    const SUB_DIRECTORY = 'stocks/';

    public function export(): void
    {
        Storage::deleteDirectory(self::STORAGE_DIRECTORY_NAME . self::SUB_DIRECTORY);

        Storage::put($this->getFilePath(), $this->pdf::loadView('welcome')->output());
    }

    public function checkExport(): bool
    {
       return Storage::exists($this->getFilePath());
    }

    public function downloadExport(): StreamedResponse
    {
        return Storage::download($this->getFilePath());
    }

    private function getFilePath(): string
    {
        return self::STORAGE_DIRECTORY_NAME . self::SUB_DIRECTORY. self::FILE_NAME . '.pdf';
    }
}
