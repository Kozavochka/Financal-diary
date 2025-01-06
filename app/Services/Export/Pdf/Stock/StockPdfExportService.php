<?php

namespace App\Services\Export\Pdf\Stock;


use App\Models\Assets\Stock;
use App\Services\DTO\StockDTO;
use App\Services\Export\Pdf\AbstractPdfExportService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class StockPdfExportService extends AbstractPdfExportService
{
    const FILE_NAME = 'stock_export_pdf';

    const SUB_DIRECTORY = 'stocks/';

    public function export(): void
    {
        Storage::deleteDirectory(self::STORAGE_DIRECTORY_NAME . self::SUB_DIRECTORY);

        $this->exportData();
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

    private function exportData()
    {
        $stocksDataCollection = collect();

        $totalStockSum = 0;

        Stock::query()
            ->with('industry')
            ->chunkById(self::CHUNK_SIZE, function (Collection $stocks) use (&$stocksDataCollection, &$totalStockSum) {
                /** @var Stock $stock */
                foreach ($stocks as $stock) {
                    $stocksDataCollection->push(
                        new StockDTO($stock)
                    );
                    $totalStockSum = bcadd($totalStockSum, $stock->total_price, 2);
                }
            });

        Storage::put($this->getFilePath(), $this->pdf::loadView(
            'pdf.stock_export_pdf',
            compact('totalStockSum', 'stocksDataCollection')
        )
            ->output());
    }
}
