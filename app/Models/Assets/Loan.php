<?php

namespace App\Models\Assets;

use App\Enums\DirectionNameEnums;
use App\Models\Company;
use App\Models\Direction;
use App\Traits\HasDirection;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $direction_id
 * @property int $company_id
 * @property float $price
 * @property float $percent
 * @property string $repayment_schedule_type
 * @property string $payment_type
 * @property int $payment_day
 * @property Carbon $expiration_date
 * @property Company $company
 */
class Loan extends Model
{
    use HasFactory, HasDirection, SoftDeletes;

    protected $fillable = [
        'direction_id',
        'company_id',
        'price',
        'percent',
        'repayment_schedule_type',
        'payment_type',
        'payment_day',
        'expiration_date'
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
