<?php

namespace App\Models;


use App\Traits\HasDirection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    use HasFactory, HasDirection;

    protected $guarded = [
        'id'
    ];

}
