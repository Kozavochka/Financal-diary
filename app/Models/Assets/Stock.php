<?php

namespace App\Models\Assets;

use App\Enums\DirectionNameEnums;
use App\Models\Direction;
use App\Models\Industry;
use App\Traits\HasDirection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property string $name
 * @property string $ticker
 * @property float $price
 * @property float $lots
 * @property float $total_price
 * @property integer $direction_id
 * @property integer $industry_id
 * @property Direction $direction
 * @property Industry $industry
 */
class Stock extends Model
{
    use HasFactory;
    use HasDirection;
    use SoftDeletes;

    protected $fillable = [
        'direction_id',
        'industry_id',
        'name',
        'ticker',
        'price',
        'lots',
    ];

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

    public function getTotalPriceAttribute(): float
    {
        return round($this->price * $this->lots, 3);
    }

}
