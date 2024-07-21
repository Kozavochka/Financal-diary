<?php

namespace App\Models;


use App\Enums\DirectionNameEnums;
use App\Traits\HasDirection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property string $name
 * @property string $ticker
 * @property double $price
 * @property double $coupon
 * @property double $profit_percent
 * @property Carbon $expiration_date
 */
class Bond extends Model
{
    use HasFactory, HasDirection, SoftDeletes;

    protected $guarded = [
        'id'
    ];

    public static function boot() {
        parent::boot();

        static::creating(function ($model){

            $model->direction_id = Direction::query()
                ->where('name', DirectionNameEnums::bonds()->value)
                ->first()?->id;
        });
    }
}
