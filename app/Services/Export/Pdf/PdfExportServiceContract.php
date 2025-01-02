<?php

namespace App\Services\Export\Pdf;

interface PdfExportServiceContract
{

    public function export();

    public function setPdfSettings();

    public function render();

}
