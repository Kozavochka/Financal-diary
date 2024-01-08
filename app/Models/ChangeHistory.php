<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChangeHistory extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function cash()
    {
        return $this->belongsTo(Cash::class);
    }

    public function change_reason()
    {
        return $this->morphTo();
    }
}
