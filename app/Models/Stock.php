<?php

namespace App\Models;

use App\Traits\HasDirection;
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

    use HasFactory, HasDirection;

    protected $guarded = ['id'];



    public function industry()
    {
        return $this->belongsTo(Industry::class);
    }

    //Relation к записи изменения стоимости
    public function records()
    {
        return $this->belongsToMany(Record::class)->withPivot('price');
    }
}
