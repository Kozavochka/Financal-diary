<?php

namespace App\Services\DTO\Assets;

use App\Models\Assets\Deposit;
use App\Models\Assets\Fund;
use App\Models\Assets\Loan;

class DepositDTO
{
    private Deposit $deposit;

    public function __construct(Deposit $deposit)
    {
        $this->deposit = $deposit;
    }

    /**
     * @return Deposit
     */
    public function getDeposit(): Deposit
    {
        return $this->deposit;
    }

    /**
     * @return string
     */
    public function getBankName(): string
    {
       return $this->deposit->bank?->name;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
       return $this->deposit->type;
    }


    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->deposit->price;
    }

    /**
     * @return float
     */
    public function getPercent(): float
    {
        return $this->deposit->percent;
    }
}
