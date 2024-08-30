<?php

namespace App\Http\Controllers\Admin\Assets;

use App\Http\Controllers\Controller;
use App\Http\Requests\FundRequest;
use App\Models\Assets\Fund;
use App\Services\Filters\Fund\FundSearchFilter;
use App\Services\Sorts\TotalPriceSort;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;

class AdminFundController extends Controller
{
    public function index()
    {
        $page = request('page', 1);
        $perPage = request('per_page', 10);

        $funds = QueryBuilder::for(Fund::class)
            ->allowedSorts([
                'name',
                'ticker',
                AllowedSort::custom('price', new TotalPriceSort()),
            ])
            ->allowedFilters([
                AllowedFilter::custom('search', new FundSearchFilter()),
            ])
            ->paginate($perPage, '*', 'page', $page);

        return view('admin.funds.funds', compact('funds'));
    }

    public function create()
    {
        return view('admin.funds.create');
    }


    public function store(FundRequest $request)
    {
        Fund::query()
            ->create($request->validated());

        return redirect(route('admin.funds.index'));
    }


    public function show(Fund $fund)
    {
        //
    }


    public function edit(Fund $fund)
    {
        return view('admin.funds.edit', compact('fund'));
    }


    public function update(FundRequest $request, Fund $fund)
    {
        $fund->update($request->validated());

        return redirect(route('admin.funds.index'));
    }


    public function destroy(Fund $fund)
    {
        $fund->delete();

        return redirect(route('admin.funds.index'));
    }
}
