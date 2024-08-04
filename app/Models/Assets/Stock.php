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
 * @property double $price
 * @property integer $lots
 * @property double $total_price
 */
class Stock extends Model
{

    use HasFactory;
    use HasDirection;
    use SoftDeletes;

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
