<?php

namespace App\Services\Filters\Loan;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;

class LoanSearchFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        if (is_array($value)){
            $value = implode($value);
        }

        return $query
            ->whereHas('company', (function (Builder $query) use ($value) {
                $query->where('name',"ilike", "%$value%");
            }));
    }
}
