<?php

namespace App\Models;

use App\Models\Assets\Loan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $name
 * @property string $inn
 * @property string $ogrn
 */
class Company extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'inn',
        'ogrn',
    ];

    /**
     * @return HasMany
     */
    public function loans(): HasMany
    {
        return $this->hasMany(Loan::class);
    }
}
