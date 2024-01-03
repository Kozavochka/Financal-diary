<?php

namespace App\Models;

use App\Enums\DirectionNameEnums;
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

    public static function boot() {
        parent::boot();

        static::creating(function ($model){

            $model->direction_id = Direction::query()
                ->where('name', DirectionNameEnums::stocks()->value)
                ->first()?->id;
        });
    }

    public function industry()
    {
        return $this->belongsTo(Industry::class);
    }

}
