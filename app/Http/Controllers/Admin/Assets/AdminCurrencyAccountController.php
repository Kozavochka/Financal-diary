<?php

namespace App\Http\Controllers\Admin\Assets;

use App\Http\Controllers\Controller;
use App\Http\Requests\CurrencyAccountRequest;
use App\Models\CurrencyAccount;
use App\Models\CurrencyType;
use Illuminate\Http\Request;

class AdminCurrencyAccountController extends Controller
{

    public function index()
    {
        $currencies = CurrencyAccount::all();

        return view('admin.currency.index',compact('currencies'));
    }


    public function create()
    {
        $currencyTypes = CurrencyType::all();

        return view('admin.currency.create',compact('currencyTypes'));
    }


    public function store(CurrencyAccountRequest $request)
    {

        CurrencyAccount::query()
            ->create($request->validated());

        return redirect()->route('admin.currency.index');
    }


    public function show(CurrencyAccount $currency)
    {
        //
    }


    public function edit(CurrencyAccount $currency)
    {
        $currencyTypes = CurrencyType::all();

        return view('admin.currency.edit',compact('currencyTypes','currency'));
    }


    public function update(CurrencyAccountRequest $request, CurrencyAccount $currency)
    {

        $currency->update($request->validated());

        return redirect()->route('admin.currency.index');
    }


    public function destroy(CurrencyAccount $currency)
    {
        $currency->delete();

        return redirect()->route('admin.currency.index');
    }
}
