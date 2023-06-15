<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;

    protected $fillable = [
        'price',
        'description',
        'income_type_id'
    ];

    public function income_type()
    {
        return $this->belongsTo(IncomeType::class);
    }
}
