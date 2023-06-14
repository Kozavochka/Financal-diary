<?php

namespace App\Http\Controllers\Admin\Record;

use App\Http\Controllers\Controller;
use App\Http\Requests\StockRecordRequest;
use App\Models\Record;
use App\Models\Stock;
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

        $record = Record::query()->create($data);//Создание записи
        $stocks = $data['stocks'];//Получение акций
        //Проход по акциям, запись в отслеживание и обновление цены в модели
        foreach ($stocks as $stock){
            $record->stocks()->attach($stock['stock_id'],
                ['price' => $stock['price']]);

            Stock::where('id', $stock['stock_id'])
                ->update(['price' => $stock['price']]);
        }

//        $record->stocks()->attach($data['stocks']);//Запись цены в stock_record, без обновления в модели

        return redirect()->route('admin.record.index');
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
