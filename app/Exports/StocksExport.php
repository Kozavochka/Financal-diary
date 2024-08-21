<?php

namespace App\Exports;

use App\Models\Assets\Stock;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class StocksExport implements FromView,ShouldAutoSize
{
    public function view(): \Illuminate\Contracts\View\View
    {
        return view('excel.stock', [
            'stocks' => Stock::query()
            ->with('industry')
            ->get()
        ]);
    }
}
