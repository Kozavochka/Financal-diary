<?php

namespace App\Services\PDF;

use App\Models\Industry;
use App\Models\Stock;
use Dompdf\Dompdf;
use Dompdf\Options;
use http\Env;
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
        $options = new Options();
        $options->setChroot(__DIR__);

        $pdf = new Dompdf($options);

        $pdf->set_base_path( __DIR__ );

        $pdf->loadHtml(view('pdf.general_pdf', compact('data', 'total', 'stocks', 'industries')),
            'UTF-8');
        $pdf->setPaper('A4', 'portrait');
        $pdf->render();
        $pdf->stream('general.pdf');
    }
}
