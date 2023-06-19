<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BondRequest;
use App\Models\Bond;
use App\Models\Stock;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class AdminBondController extends Controller
{

    public function index()
    {
        $page = request('page', 1);
        $perPage = request('per_page', 10);

        $bonds = QueryBuilder::for(Bond::class)
            ->allowedFilters([
                AllowedFilter::callback('asc_percent', function (Builder $query){
                    $query->orderBy('profit_percent', 'asc');
                }),
                AllowedFilter::callback('asc_coupon', function (Builder $query){
                    $query->orderBy('coupon', 'asc');
                }),
                AllowedFilter::callback('asc_date', function (Builder $query){
                    $query->orderBy('expiration_date', 'asc');
                })
            ])
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
        $bond->refresh();

        return redirect(route('admin.bonds.index'));
    }

    public function destroy(Bond $bond)
    {
        $bond->delete();

        return redirect(route('admin.bonds.index'));
    }
}
