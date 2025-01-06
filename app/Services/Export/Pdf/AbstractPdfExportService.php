<?php

namespace App\Services\Export\Pdf;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

abstract class AbstractPdfExportService
{
    const STORAGE_DIRECTORY_NAME = 'export/pdf/';

    const CHUNK_SIZE = 20;

    protected Pdf $pdf;

    public function __construct()
    {
        $this->pdf = new Pdf();
    }

    public function checkExport(): bool
    {
        return Storage::exists($this->getFilePath());
    }

    public function downloadExport(): StreamedResponse
    {
        return Storage::download($this->getFilePath());
    }

    abstract public function export(): void;

    abstract protected function getFilePath();

}
