<?php

namespace App\Http\Controllers\Admin\Assets;

use App\Http\Controllers\Controller;
use App\Http\Requests\BondRequest;
use App\Models\Assets\Bond;
use App\Services\Filters\Bond\BondSearchFilter;
use App\Services\Sorts\TotalPriceSort;
use Carbon\Carbon;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;


class AdminBondController extends Controller
{

    public function index()
    {
        $page = request('page', 1);
        $perPage = request('per_page', 10);

        Bond::query()->where('expiration_date','<', Carbon::now())->delete();

        $bonds = QueryBuilder::for(Bond::class)
            ->allowedSorts([
                'name',
                'ticker',
                'expiration_date',
                'coupon_percent',
                AllowedSort::custom('price', new TotalPriceSort()),
            ])
            ->allowedFilters([
                AllowedFilter::custom('search', new BondSearchFilter()),
            ])
            ->defaultSort('coupon_percent')
            ->paginate($perPage, '*', 'page', $page);

        return view('admin.bonds.index', compact('bonds'));
    }


    public function create()
    {
        return view('admin.bonds.create');
    }


    public function store(BondRequest $request)
    {
        $data = $request->validated();

        Bond::query()
            ->create($data);

        return redirect(route('admin.bonds.index'));
    }

    public function show(Bond $bond)
    {
        //
    }


    public function edit(Bond $bond)
    {
        return view('admin.bonds.edit', compact('bond'));
    }


    public function update(BondRequest $request, Bond $bond)
    {
        $data = $request->validated();

        $bond->update($data);

        return redirect(route('admin.bonds.index'));
    }

    public function destroy(Bond $bond)
    {
        $bond->delete();

        return redirect(route('admin.bonds.index'));
    }
}
