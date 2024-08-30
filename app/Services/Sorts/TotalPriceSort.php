<?php

namespace App\Services\Sorts;


use Illuminate\Database\Eloquent\Builder;

/**
 * Sorts model when exists columns lots and price
 */
class TotalPriceSort extends BaseSort
{
    protected $column = 'lots*price';
}
