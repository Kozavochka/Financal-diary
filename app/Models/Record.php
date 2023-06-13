<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
    ];

    //relation к акциям
    public function stocks()
    {
        return $this->belongsToMany(Stock::class);
    }
}
