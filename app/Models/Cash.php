<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cash extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function change_histroies()
    {
        return $this->hasMany(ChangeHistory::class);
    }
}
