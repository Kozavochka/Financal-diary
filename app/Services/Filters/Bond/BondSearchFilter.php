<?php

namespace App\Services\Filters\Bond;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;

class BondSearchFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        if (is_array($value)){
            $value = implode($value);
        }

        return $query
            ->where(function (Builder $query) use($value) {
                $query
                    ->where('name',"ilike", "%$value%")
                    ->orWhere('ticker',"ilike", "%$value%");
            });
    }
}
