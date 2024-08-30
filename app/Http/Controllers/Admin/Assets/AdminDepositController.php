<?php

namespace App\Http\Controllers\Admin\Assets;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepositRequest;
use App\Models\Assets\Deposit;
use App\Models\Bank;
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
        $banks = Bank::all();

        return view('admin.deposit.create', compact('banks'));
    }

    public function store(DepositRequest $request)
    {
       Deposit::query()
           ->create($request->validated());

       return redirect(route('admin.deposits.index'));
    }


    public function edit(Deposit $deposit)
    {
        $banks = Bank::all();

        return view('admin.deposit.edit',compact('deposit', 'banks'));
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
