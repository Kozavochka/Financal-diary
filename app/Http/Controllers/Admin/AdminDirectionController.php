<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Direction;
use Illuminate\Http\Request;

class AdminDirectionController extends Controller
{
    public function index()
    {

        $page = request('page', 1);
        $perPage = request('per_page', 10);

        $directions = Direction::query()
            ->withCount(['stocks','bonds','funds','cryptos','loans'])
            ->paginate($perPage, '*', 'page', $page);

        return view('admin.directions.index', compact('directions'));

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
        $directions = Direction::query()->get();

        return view('admin.stocks.edit', compact('stock', 'industries', 'directions'));
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
