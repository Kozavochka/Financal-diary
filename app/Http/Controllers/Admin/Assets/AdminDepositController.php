<?php

namespace App\Http\Controllers\Admin\Assets;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepositRequest;
use App\Models\Deposit;
use function view;

class AdminDepositController extends Controller
{

    public function index()
    {
        $deposits = Deposit::all();

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
