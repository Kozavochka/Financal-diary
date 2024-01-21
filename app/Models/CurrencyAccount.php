<?php

namespace App\Models;

use App\Traits\HasDirection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrencyAccount extends Model
{
    use HasFactory,HasDirection;

    protected $guarded = ['id'];

    public function currency_type()
    {
        return $this->belongsTo(CurrencyType::class);
    }
}
