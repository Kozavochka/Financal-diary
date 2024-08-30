<?php

namespace App\Services\Filters\Stock;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;

class StockNameContainsFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        if (is_array($value)){
            $value = implode($value);
        }

        return $query->where('name',"ilike", "%$value%")
            ->orWhere('ticker',"ilike", "%$value%");
    }
}
