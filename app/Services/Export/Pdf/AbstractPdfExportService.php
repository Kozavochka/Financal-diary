<?php

namespace App\Services\Export\Pdf;

use Barryvdh\DomPDF\Facade\Pdf;
use Symfony\Component\HttpFoundation\StreamedResponse;

abstract class AbstractPdfExportService
{
    const STORAGE_DIRECTORY_NAME = 'export/pdf/';

    protected Pdf $pdf;

    public function __construct()
    {
        $this->pdf = new Pdf();
    }

    abstract public function export(): void;

    abstract public function checkExport(): bool;

    abstract public function downloadExport(): StreamedResponse;

}
