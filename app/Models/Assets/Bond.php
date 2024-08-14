<?php

namespace App\Models\Assets;


use App\Enums\DirectionNameEnums;
use App\Models\Direction;
use App\Traits\HasDirection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property string $name
 * @property string $ticker
 * @property double $price
 * @property double $lots
 * @property double $total_price
 * @property double $coupon
 * @property double $profit_percent
 * @property double $coupon_percent
 * @property Carbon $expiration_date
 * @property integer $coupon_day_period
 */
class Bond extends Model
{
    use HasFactory, HasDirection, SoftDeletes;

    protected $fillable = [
        'name',
        'ticker',
        'price',
        'lots',
        'coupon',
        'profit_percent',
        'coupon_percent',
        'expiration_date',
        'coupon_day_period',
    ];

    public static function boot() {
        parent::boot();

        static::creating(function ($model){

            $model->direction_id = Direction::query()
                ->where('name', DirectionNameEnums::bonds()->value)
                ->first()?->id;
        });
    }

    public function getTotalPriceAttribute(): float
    {
        return round($this->price * $this->lots, 3);
    }
}
