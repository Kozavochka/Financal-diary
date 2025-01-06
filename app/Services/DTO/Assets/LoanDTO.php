<?php

namespace App\Services\DTO\Assets;

use App\Models\Assets\Loan;

class LoanDTO
{
    private Loan $loan;

    public function __construct(Loan $loan)
    {
        $this->loan = $loan ;
    }

    /**
     * @return Loan
     */
    public function getLoan(): Loan
    {
        return $this->loan;
    }

    /**
     * @return string
     */
    public function getCompanyName(): string
    {
       return $this->loan->company?->name;
    }


    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->loan->price;
    }

    /**
     * @return float
     */
    public function getPercent(): float
    {
        return $this->loan->percent;
    }
}
