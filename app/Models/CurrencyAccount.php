<?php

namespace App\Models;

use App\Enums\DirectionNameEnums;
use App\Traits\HasDirection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrencyAccount extends Model
{
    use HasFactory,HasDirection;

    protected $guarded = ['id'];

    protected $with = ['currency_type'];

    public static function boot() {
        parent::boot();

        static::creating(function ($model){

            $model->direction_id = Direction::query()
                ->where('name', DirectionNameEnums::currencies()->value)
                ->first()?->id;
        });
    }

    public function currency_type()
    {
        return $this->belongsTo(CurrencyType::class);
    }
}
