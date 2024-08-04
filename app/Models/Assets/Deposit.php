<?php

namespace App\Models\Assets;

use App\Enums\DirectionNameEnums;
use App\Models\Direction;
use App\Traits\HasDirection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    use HasFactory,HasDirection;

    protected $guarded = ['id'];
    protected $casts = [
        'expiration_date' => 'date'
    ];

    public static function boot() {
        parent::boot();

        static::creating(function ($model){

            $model->direction_id = Direction::query()
                ->where('name', DirectionNameEnums::deposits()->value)
                ->first()?->id;
        });
    }
}
