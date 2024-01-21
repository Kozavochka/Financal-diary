<?php

namespace App\Http\Controllers\Admin\Assets;

use App\Http\Controllers\Controller;
use App\Models\CurrencyAccount;
use Illuminate\Http\Request;

class AdminCurrencyAccountController extends Controller
{

    public function index()
    {
        $currencies = CurrencyAccount::all();

        dd($currencies);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
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
