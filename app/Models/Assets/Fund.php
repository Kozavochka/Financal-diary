<?php

namespace App\Models\Assets;

use App\Enums\DirectionNameEnums;
use App\Models\Direction;
use App\Traits\HasDirection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property string $name
 * @property string $ticker
 * @property double $price
 * @property double $lots
 * @property double $total_price
 * @property Direction $direction
 */
class Fund extends Model
{
    use HasFactory, HasDirection, SoftDeletes;

    protected $fillable = [
        'name',
        'ticker',
        'lots',
        'price',
        'direction_id'
    ];

    public static function boot() {
        parent::boot();

        static::creating(function ($model){

            $model->direction_id = Direction::query()
                ->where('name', DirectionNameEnums::funds()->value)
                ->first()?->id;
        });
    }

    public function getTotalPriceAttribute(): float
    {
        return round($this->price * $this->lots, 3);
    }
}
