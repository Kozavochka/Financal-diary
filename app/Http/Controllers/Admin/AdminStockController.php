<?php

namespace App\Http\Controllers\Admin;


use App\Exports\StocksExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\StockRequest;
use App\Models\Direction;
use App\Models\Industry;
use App\Models\Stock;
use Dflydev\DotAccessData\Data;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;


class AdminStockController extends Controller
{

    public function index()
    {
        $page = request('page', 1);
        $perPage = request('per_page', 10);

        $stocks = QueryBuilder::for(Stock::class)
            ->with('industry')
            ->allowedFilters([
                AllowedFilter::callback('asc_price', function (Builder $query){
                    $query->orderByRaw('total_price');
                })
            ])
            ->orderByRaw('total_price desc')
            ->paginate($perPage, '*', 'page', $page);

        return view('admin.stocks.stocks', compact('stocks'));

    }


    public function create()
    {
        $industries = Industry::query()
            ->distinct()
            ->get();
        $directions = Direction::query()->get();

        return view('admin.stocks.create', compact('industries', 'directions'));
    }


    public function store(StockRequest $request)
    {
        $data = $request->validated();

        $data['total_price'] = round($data['price'] * $data['lots'],2) ?? 0;

        Stock::query()
            ->create($data);

        return redirect(route('admin.stocks.index'));
    }


    public function show($id)
    {
        //
    }


    public function edit(Stock $stock)
    {
        $stock->loadMissing(['industry', 'direction']);

        $industries = Industry::query()
            ->distinct()
            ->get();

        return view('admin.stocks.edit', compact('stock', 'industries'));
    }


    public function update(StockRequest $request, Stock $stock)
    {
        $data = $request->validated();

        $stock->update($data);
        $stock->refresh();

        return redirect(route('admin.stocks.index'));
    }


    public function destroy(Stock $stock)
    {
        $stock->delete();

        return redirect(route('admin.stocks.index'));
    }

    public function excel_export()
    {
        return Excel::download(new StocksExport, 'stocks.xlsx');

    }
}
