<?php

namespace App\Models;

use App\Traits\HasAsset;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direction extends Model
{
    use HasFactory, HasAsset;

    protected $guarded =[];

    public function total_statistic_item()
    {
        return $this->hasMany(TotalStatisticItem::class);
    }
}
