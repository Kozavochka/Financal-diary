<?php

namespace App\Http\Controllers\Admin\Assets;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use Illuminate\Http\Request;

class AdminCurrencyController extends Controller
{

    public function index()
    {
        $currencies = Currency::all();

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


    public function show(Currency $currency)
    {
        //
    }


    public function edit(Currency $currency)
    {
        //
    }


    public function update(Request $request, Currency $currency)
    {
        //
    }


    public function destroy(Currency $currency)
    {
        //
    }
}
