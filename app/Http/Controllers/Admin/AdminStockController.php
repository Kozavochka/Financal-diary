<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StockRequest;
use App\Models\Industry;
use App\Models\Stock;
use Dflydev\DotAccessData\Data;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class AdminStockController extends Controller
{

    public function index()
    {
        $page = request('page', 1);
        $perPage = request('per_page', 10);


        $stocks =QueryBuilder::for(Stock::class)
            ->with(['industry', 'records'])
            ->allowedFilters([
                AllowedFilter::callback('asc_price', function (Builder $query){
                    $query->orderByRaw('price*lots');
                })
            ])
            ->paginate($perPage, '*', 'page', $page);


//        dd($stocks[0]->records[0]->pivot->price);

        $labels = $stocks->pluck('name');

        $data = $stocks->pluck('total_price');
        return view('admin.stocks.stocks', compact('stocks', 'labels', 'data'));
    }


    public function create()
    {
        return view('admin.stocks.create');
    }


    public function store(StockRequest $request)
    {
        $data = $request->validated();

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
}
