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
        dd($request->validated());
    }


    public function show(CurrencyAccount $currency)
    {
        //
    }


    public function edit(CurrencyAccount $currency)
    {
        //
    }


    public function update(Request $request, CurrencyAccount $currency)
    {
        //
    }


    public function destroy(CurrencyAccount $currency)
    {
        //
    }
}
