<?php

namespace App\Services\DTO\Assets;

use App\Models\Assets\Bond;
use Illuminate\Support\Carbon;

class BondDTO
{
    private Bond $bond;

    public function __construct(Bond $bond)
    {
        $this->bond = $bond;
    }

    /**
     * @return Bond
     */
    public function getBond(): Bond
    {
        return $this->bond;
    }

    /**
     * @return string
     */
    public function getTicker(): string
    {
       return $this->bond->ticker;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->bond->name;
    }

    /**
     * @return float
     */
    public function getLots(): float
    {
        return $this->bond->lots;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->bond->price;
    }

    /**
     * @return float
     */
    public function getTotalPrice(): float
    {
        return $this->bond->total_price;
    }

    /**
     * @return float
     */
    public function getCouponPercent(): float
    {
        return $this->bond->coupon_percent;
    }

    /**
     * @return string
     */
    public function getExpirationDate(): string
    {
        return $this->bond->expiration_date;
    }

    /**
     * @return int
     */
    public function getCouponDayPeriod():int
    {
        return $this->bond->coupon_day_period;
    }
}
