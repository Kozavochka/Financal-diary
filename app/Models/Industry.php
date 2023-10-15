<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Industry extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    //Relation to Stock
    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }
}
