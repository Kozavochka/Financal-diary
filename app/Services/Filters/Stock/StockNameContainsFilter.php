<?php

namespace App\Services\Filters\Stock;

use App\Services\Filters\BaseContainsFilter;

class StockNameContainsFilter extends BaseContainsFilter
{
    protected $column = "name";
}
