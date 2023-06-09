<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * @property string $name
 * @property double $price
 * @property int $count_bus
 */
class Loan extends Model
{
    use HasFactory;


    protected $guarded = [
        'id'
    ];
}
