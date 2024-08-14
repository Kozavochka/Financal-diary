<?php

namespace App\Services\Filters;


use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;

class BaseContainsFilter implements Filter
{
    protected $column;

    public function __invoke(Builder $query, $value, string $property) {

        if (is_array($value)){
            $value = implode($value);
        }

        return $query->orWhere($this->column, "ilike", "%$value%");
    }
}
