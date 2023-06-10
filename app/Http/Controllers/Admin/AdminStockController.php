<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StockRequest;
use App\Models\Stock;
use Illuminate\Http\Request;

class AdminStockController extends Controller
{

    public function index()
    {
        return view('admin..stocks.stocks');
    }


    public function create()
    {
        return view('admin.stocks.create');
    }


    public function store(StockRequest $request)
    {
        $data = $request->validated();
//         dd($data);
        Stock::query()
            ->create($data);

        return redirect(route('admin.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
