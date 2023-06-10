<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StockRequest;
use App\Models\Stock;
use Illuminate\Http\Request;

class AdminStockController extends Controller
{

    public function index()
    {

        $stocks = Stock::query()->get();

        return view('admin.stocks.stocks', compact('stocks'));
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
        return view('admin.stocks.edit', compact('stock'));
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
