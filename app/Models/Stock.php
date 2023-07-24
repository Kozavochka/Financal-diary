<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $name
 * @property string $ticker
 * @property double $price
 * @property integer $lots
 * @property double $total_price
 */
class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', //название компании
        'ticker',//тикер
        'price',//цена за 1шт
        'lots',//сколько лотов
        'industry_id',//отрасль
    ];


    public function industry()
    {
        return $this->belongsTo(Industry::class);
    }

    //Аксессор получения общей суммы
    public function getTotalPriceAttribute()
    {
        return bcdiv($this->price * $this->lots, 1 , 2);
    }

    //Relation к записи изменения стоимости
    public function records()
    {
        return $this->belongsToMany(Record::class)->withPivot('price');
    }
}
