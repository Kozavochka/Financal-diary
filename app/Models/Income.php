<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * @property double $price
 * @property string $description
 * @property integer $income_type_id
*/
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

    public function change_history()
    {
        return $this->morphOne(ChangeHistory::class,'change_reason');
    }
}
