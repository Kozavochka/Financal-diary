<?php

namespace App\Services\Export\Pdf\Bond;


use App\Models\Assets\Bond;
use App\Services\DTO\Assets\BondDTO;
use App\Services\Export\Pdf\AbstractPdfExportService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class BondPdfExportService extends AbstractPdfExportService
{
    const FILE_NAME = 'bonds_export_pdf';

    const SUB_DIRECTORY = 'bonds/';

    public function export(): void
    {
        Storage::deleteDirectory(self::STORAGE_DIRECTORY_NAME . self::SUB_DIRECTORY);

        $this->exportData();
    }

    protected function getFilePath(): string
    {
        return self::STORAGE_DIRECTORY_NAME . self::SUB_DIRECTORY. self::FILE_NAME . '.pdf';
    }

    private function exportData()
    {
        $bondsDataCollection = collect();

        $totalSum = 0;

        Bond::query()
            ->chunkById(self::CHUNK_SIZE, function (Collection $bonds) use (&$bondsDataCollection, &$totalSum) {
                /** @var Bond $bond */
                foreach ($bonds as $bond) {
                    $bondsDataCollection->push(
                        new BondDTO($bond)
                    );
                    $totalSum = bcadd($totalSum, $bond->total_price, 2);
                }
            });

        if ($bondsDataCollection->isNotEmpty()) {
            Storage::put($this->getFilePath(), $this->pdf::loadView(
                'pdf.bond_export_pdf',
                compact('totalSum', 'bondsDataCollection')
            )
                ->output());
        }
    }
}
