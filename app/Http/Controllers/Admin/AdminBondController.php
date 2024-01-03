<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BondRequest;
use App\Models\Bond;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class AdminBondController extends Controller
{

    public function index()
    {
        $page = request('page', 1);
        $perPage = request('per_page', 10);

        if (Bond::query()->where('expiration_date','<',Carbon::now())->exists()){
            Bond::query()->where('expiration_date','<',Carbon::now())->delete();
        }

        $bonds = QueryBuilder::for(Bond::class)
            ->allowedFilters([
                AllowedFilter::callback('asc_percent', function (Builder $query){
                    $query->orderBy('profit_percent');
                }),
                AllowedFilter::callback('asc_coupon', function (Builder $query){
                    $query->orderBy('coupon');
                }),
                AllowedFilter::callback('asc_date', function (Builder $query){
                    $query->orderBy('expiration_date');
                })
            ])
            ->orderBy('profit_percent','desc')
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
