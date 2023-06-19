<?php

namespace App\Http\Controllers;

use App\Models\Bond;
use App\Models\Crypto;
use App\Models\Fund;
use App\Models\Industry;
use App\Models\Loan;
use App\Models\Stock;
use Dompdf\Dompdf;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {   /*ВЫНЕСТИ В ОТДЕЛЬНЫЙ МЕТОД*/
        $data = [
            'stocks' =>  DB::table('stocks')
                ->selectRaw('SUM(price * lots) as total')
                ->value('total'),

            'bonds' => Bond::query()->sum('price'),

            'crypto' => Crypto::query()->sum('price') * 80,

            'loans' => Loan::query()->sum('price'),

            'funds' => Fund::query()->sum('price'),
        ];

        $total = array_sum($data);

        $labels = array_keys($data);
        $newData = [];
        $i=0;
        //Как же это убого )0)
        foreach ($data as $key => $value) {

            $newData[$i] = $value;
            $i++;
        }


        return view('home', compact('total', 'labels','newData', 'data'));
    }

    public function pdf_export()
    {   /*ВЫНЕСТИ В ОТДЕЛЬНЫЙ МЕТОД*/
        $data = [
            'stocks' =>  DB::table('stocks')
                ->selectRaw('SUM(price * lots) as total')
                ->value('total'),

            'bonds' => Bond::query()->sum('price'),

            'crypto' => Crypto::query()->sum('price') * 80,

            'loans' => Loan::query()->sum('price'),

            'funds' => Fund::query()->sum('price'),
        ];


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
