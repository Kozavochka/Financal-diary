<?php

namespace App\Http\Controllers\Guest;

use App\Exports\StocksExport;
use App\Http\Controllers\Controller;
use App\Models\Industry;
use App\Models\Settings;
use App\Models\Stock;
use App\Services\DTO\SettingsDTO;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class StockController extends Controller
{

    public function index()
    {
        $page = request('page', 1);
        $perPage = request('per_page', 15);

        $stocks =QueryBuilder::for(Stock::class)
            ->with('industry')
            ->allowedFilters([
                AllowedFilter::callback('asc_price', function (Builder $query){
                    $query->orderByRaw('price*lots');
                }),
                AllowedFilter::exact('industry_id'),
            ])
            ->paginate($perPage, '*', 'page', $page);

        $industries = Industry::query()
            ->withCount('stocks')
            ->get();
        return view('guest.stock.index', compact('stocks', 'industries'));
    }


    public function create()
    {
        return redirect()->route('stocks.index');
    }


    public function store(Request $request)
    {
        return redirect()->route('stocks.index');
    }


    public function show(Stock $stock)
    {
        $total = new  SettingsDTO(
            Settings::query()
                ->where('key','total_price')
                ->first()
        );

        return view('guest.stock.show', compact('stock', 'total'));
    }


    public function edit($id)
    {
        return redirect()->route('stocks.index');
    }


    public function update(Request $request, $id)
    {
        return redirect()->route('stocks.index');
    }


    public function destroy($id)
    {
        return redirect()->route('stocks.index');
    }

    public function excel_export()
    {
        return Excel::download(new StocksExport, 'stocks.xlsx');
    }
}
