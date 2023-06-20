<?php

namespace App\Http\Controllers\Admin\Record;

use App\Http\Controllers\Controller;
use App\Http\Requests\StockRecordRequest;
use App\Models\Record;
use App\Models\Stock;
use App\Services\Record\StocksStore;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class StockRecordController extends Controller
{

    public function index()
    {  $page = request('page', 1);
        $perPage = request('per_page', 10);

        $records = Record::query()
            ->with('stocks')
            ->paginate($perPage, '*', 'page', $page);

        $stocks_dist = Stock::query()
            ->orderByRaw('price*lots desc')
            ->get();

        return view('admin.record.stock.index', compact('records', 'stocks_dist'));
    }


    public function create()
    {
        $stocks = Stock::query()
            ->orderByRaw('price*lots desc')
            ->get();

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
