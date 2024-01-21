<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrencyType extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function currencies()
    {
        return $this->hasMany(CurrencyAccount::class);
    }
}
