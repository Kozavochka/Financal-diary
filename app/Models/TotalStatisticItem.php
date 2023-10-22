<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * @property integer $id
 * @property integer $statistic_id
 * @property integer $direction_id
 * @property double $sum
 */
class TotalStatisticItem extends Model
{
    use HasFactory;

    protected $guarded = ['created_at'];

    protected $with = ['direction'];

    public function statistic()
    {
        return $this->belongsTo(TotalStatistic::class);
    }

    public function direction()
    {
        return $this->belongsTo(Direction::class);
    }
}
