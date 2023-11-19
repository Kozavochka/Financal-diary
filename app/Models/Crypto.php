<?php

namespace App\Models;

use App\Traits\HasDirection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * @property string $name
 * @property string $ticker
 * @property double $price
 * @property integer $lots
 */
class Crypto extends Model
{
    use HasFactory, HasDirection;

    protected $guarded = [
        'id'
    ];
}
