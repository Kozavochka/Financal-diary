<?php

namespace App\Models;

use App\Models\Assets\Stock;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $name
 */
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
