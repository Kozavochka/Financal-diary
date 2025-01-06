<?php

namespace App\Services\DTO\Assets;

use App\Models\Assets\Fund;
use App\Models\Assets\Loan;

class FundDTO
{
    private Fund $fund;

    public function __construct(Fund $fund)
    {
        $this->fund = $fund;
    }

    /**
     * @return Fund
     */
    public function getFund(): Fund
    {
        return $this->fund;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
       return $this->fund->name;
    }

    /**
     * @return string
     */
    public function getTicker(): string
    {
       return $this->fund->ticker;
    }


    /**
     * @return float
     */
    public function getLots(): float
    {
        return $this->fund->lots;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->fund->price;
    }

    /**
     * @return float
     */
    public function getTotalPrice(): float
    {
        return $this->fund->total_price;
    }
}
