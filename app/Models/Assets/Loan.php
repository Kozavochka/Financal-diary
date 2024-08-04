<?php

namespace App\Models\Assets;

use App\Enums\DirectionNameEnums;
use App\Models\Company;
use App\Models\Direction;
use App\Traits\HasDirection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property string $name
 * @property double $price
 * @property int $count_bus
 */
class Loan extends Model
{
    use HasFactory, HasDirection, SoftDeletes;

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

    /**
     * @return BelongsTo
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
