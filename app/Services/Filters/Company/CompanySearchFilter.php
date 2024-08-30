<?php

namespace App\Services\Filters\Company;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;

class CompanySearchFilter implements Filter
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
                    ->orWhere('inn',"ilike", "%$value%")
                    ->orWhere('ogrn',"ilike", "%$value%");
            });
    }
}
