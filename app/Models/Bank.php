<?php

namespace App\Models;

use App\Models\Assets\Deposit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

/**
 * @property int $id
 * @property string $name
 * @property Collection|Deposit[] $deposits
 */
class Bank extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name'];

    /**
     * @return HasMany
     */
    public function deposits(): HasMany
    {
        return $this->hasMany(Deposit::class);
    }
}
