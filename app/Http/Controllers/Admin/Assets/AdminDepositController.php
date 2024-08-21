<?php

namespace App\Http\Controllers\Admin\Assets;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepositRequest;
use App\Models\Assets\Deposit;
use App\Services\Filters\Deposit\DepositSearchFilter;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use function view;

class AdminDepositController extends Controller
{
    public function index()
    {
        $page = request('page', 1);
        $perPage = request('per_page', 10);

        $deposits = QueryBuilder::for(Deposit::class)
            ->with('bank')
            ->allowedSorts([
                'type',
                'price',
                'percent',
                'expiration_date'
            ])
            ->allowedFilters([
                AllowedFilter::custom('search', new DepositSearchFilter()),
            ])
            ->paginate($perPage, '*', 'page', $page);

        return view('admin.deposit.index',compact('deposits'));
    }


    public function create()
    {
        return view('admin.deposit.create');
    }

    public function store(DepositRequest $request)
    {
       Deposit::query()
           ->create($request->validated());

       return redirect(route('admin.deposits.index'));
    }


    public function edit(Deposit $deposit)
    {
        return view('admin.deposit.edit',compact('deposit'));
    }


    public function update(DepositRequest $request, Deposit $deposit)
    {
        $deposit->update($request->validated());

        return redirect(route('admin.deposits.index'));
    }


    public function destroy(Deposit $deposit)
    {
        $deposit->delete();

        return redirect(route('admin.deposits.index'));
    }
}
