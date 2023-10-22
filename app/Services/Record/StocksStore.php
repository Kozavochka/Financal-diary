<?php

namespace App\Services\Record;

use App\Models\Record;
use App\Models\Stock;

class StocksStore
{
    public  static function store($data)
    {
        $record = Record::query()->create($data);//Создание записи
        $stocks = $data['stocks'];//Получение акций, можно без этой переменной, но мне так нравится
        //Проход по акциям, запись в отслеживание и обновление цены в модели
        foreach ($stocks as $stock){
            $record->stocks()->attach($stock['stock_id'],
                ['price' => $stock['price']]);

            Stock::where('id', $stock['stock_id'])
                ->update(['price' => $stock['price']]);
        }
    }
}
