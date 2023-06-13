<?php

namespace App\Http\Controllers\Admin\Record;

use App\Http\Controllers\Controller;
use App\Http\Requests\StockRecordRequest;
use App\Models\Record;
use Illuminate\Http\Request;

class StockRecordController extends Controller
{

    public function index()
    {
        return view('admin.record.index');
    }


    public function create()
    {
        return view('admin.record.stock.create');
    }


    public function store(StockRecordRequest $request)
    {
        $data = $request->validated();

        $record = Record::query()->create($data);

        $record->stocks()->attach($data['stocks']);

        dd($data);
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
