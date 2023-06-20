<?php

namespace App\Services\PDF;

use App\Models\Industry;
use App\Models\Stock;
use Dompdf\Dompdf;
use Spatie\QueryBuilder\QueryBuilder;

class PdfExportAll
{

    public static function export($data)
    {
        $stocks =QueryBuilder::for(Stock::class)
            ->with(['industry', 'records'])
            ->get();

        $industries = Industry::query()
            ->withCount('stocks')
            ->get();

        $total = array_sum($data);

        $pdf = new Dompdf();
        $pdf->loadHtml(view('pdf.general_pdf', compact('data', 'total', 'stocks', 'industries')));
        $pdf->setPaper('A4', 'portrait');
        $pdf->render();

        return $pdf->stream('general.pdf');
    }
}
