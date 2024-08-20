<?php

namespace App\Services\Sorts\Crypto;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Sorts\Sort;

class CryptoPriceSort implements Sort
{
    public function __invoke(Builder $query, bool $descending, string $property)
    {
        $direction = $descending ? 'DESC' : 'ASC';

        $query->orderByRaw("ABS(`lots*price`) $direction");
    }
}
