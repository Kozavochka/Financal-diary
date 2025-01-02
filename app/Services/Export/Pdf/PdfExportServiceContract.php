<?php

namespace App\Services\PDF;

interface PdfExportServiceContract
{

    public function export();

    public function setPdfSettings();

    public function render();

}
