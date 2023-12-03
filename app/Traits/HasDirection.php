<?php

namespace App\Traits;

use App\Models\Direction;

trait HasDirection
{

    public function direction()
    {
        return $this->belongsTo(Direction::class)->withTrashed();
    }

}
