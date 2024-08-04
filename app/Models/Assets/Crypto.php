<?php

namespace App\Models\Assets;

use App\Enums\DirectionNameEnums;
use App\Models\Direction;
use App\Traits\HasDirection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $name
 * @property string $ticker
 * @property double $price
 * @property integer $lots
 */
class Crypto extends Model
{
    use HasFactory, HasDirection;

    protected $guarded = [
        'id'
    ];

    public static function boot() {
        parent::boot();

        static::creating(function ($model){

            $model->direction_id = Direction::query()
                ->where('name', DirectionNameEnums::cryptos()->value)
                ->first()?->id;
        });
    }
}
