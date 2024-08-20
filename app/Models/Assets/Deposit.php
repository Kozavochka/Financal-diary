<?php

namespace App\Models\Assets;

use App\Enums\DirectionNameEnums;
use App\Models\Bank;
use App\Models\Direction;
use App\Traits\HasDirection;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * @property integer $bank_id
 * @property integer $direction_id
 * @property string $type
 * @property double $price
 * @property double $percent
 * @property Carbon $expiration_date
 * @property Direction $direction
 * @property Bank $bank
 */
class Deposit extends Model
{
    use HasFactory, HasDirection, SoftDeletes;

    protected $fillable = [
        'bank_id',
        'type',
        'price',
        'percent',
        'expiration_date',
        'direction_id',
    ];

    public static function boot() {
        parent::boot();

        static::creating(function ($model){

            $model->direction_id = Direction::query()
                ->where('name', DirectionNameEnums::deposits()->value)
                ->first()?->id;
        });
    }

    /**
     * @return BelongsTo
     */
    public function bank(): BelongsTo
    {
        return $this->belongsTo(Bank::class);
    }
}
