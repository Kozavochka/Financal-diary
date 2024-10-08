<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BankRequest;
use App\Models\Assets\Deposit;
use App\Models\Bank;
use Spatie\QueryBuilder\QueryBuilder;

class AdminBankController extends Controller
{
    public function index()
    {
        $page = request('page', 1);
        $perPage = request('per_page', 10);

        $banks = QueryBuilder::for(Bank::class)
            ->withCount('deposits')
            ->withSum('deposits','price')
            ->allowedSorts([
                'name',
            ])
            ->allowedFilters([
                'name'
            ])
            ->paginate($perPage, '*', 'page', $page);

        return view('admin.deposit.bank.index', compact('banks'));
    }

    public function create()
    {
        return view('admin.deposit.bank.create');
    }

    public function store(BankRequest $request)
    {
        Bank::query()
            ->create($request->validated());

        return redirect(route('admin.bank.index'));
    }


    public function edit(Bank $bank)
    {
        return view('admin.deposit.bank.edit', compact('bank'));
    }


    public function update(BankRequest $request, Bank $bank)
    {
        $bank->update($request->validated());

        return redirect(route('admin.bank.index'));
    }

    public function destroy(Bank $bank)
    {
        Deposit::query()
            ->where('bank_id', $bank->id)
            ->delete();

        $bank->delete();

        return redirect(route('admin.bank.index'));
    }

    public function show(Bank $bank)
    {
        return view('admin.deposit.bank.show',compact('bank'));
    }
}
