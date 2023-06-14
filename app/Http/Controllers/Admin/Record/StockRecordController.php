<?php

namespace App\Http\Controllers\Admin\Record;

use App\Http\Controllers\Controller;
use App\Http\Requests\StockRecordRequest;
use App\Models\Record;
use App\Models\Stock;
use App\Services\Record\StocksStore;
use Illuminate\Http\Request;

class StockRecordController extends Controller
{

    public function index()
    {
        return view('admin.record.index');
    }


    public function create()
    {
        $stocks = Stock::query()->get();

        return view('admin.record.stock.create', compact('stocks'));
    }


    public function store(StockRecordRequest $request)
    {
        $data = $request->validated();

        StocksStore::store($data);

        return redirect()->route('admin.stocks.index');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
