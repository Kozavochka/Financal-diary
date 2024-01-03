<?php

namespace App\Models;

use App\Enums\DirectionNameEnums;
use App\Traits\HasDirection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * @property string $name
 * @property double $price
 * @property int $count_bus
 */
class Loan extends Model
{
    use HasFactory, HasDirection;

    protected $guarded = [
        'id'
    ];

    public static function boot() {
        parent::boot();

        static::creating(function ($model){

            $model->direction_id = Direction::query()
                ->where('name', DirectionNameEnums::loans()->value)
                ->first()?->id;
        });
    }
}
