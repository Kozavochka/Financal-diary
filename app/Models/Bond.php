<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $name
 * @property string $ticker
 * @property double $price
 * @property double $coupon
 * @property double $profit_percent
 */
class Bond extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

}
