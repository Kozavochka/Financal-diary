<?php

namespace App\Services\Filters\Bond;

use App\Services\Filters\BaseContainsFilter;

class BondNameContainsFilter extends BaseContainsFilter
{
    protected $column = "name";
}
