<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $user_id
 * @property double $total_sum
 */
class TotalStatistic extends Model
{
    use HasFactory;

    protected $guarded = ['created_at'];

    protected $with = ['items'];

    protected $casts = [
        'created_at' => 'datetime'
    ];

    public function items()
    {
        return $this->hasMany(TotalStatisticItem::class);
    }

}
