<?php

namespace App\Services\DTO\Assets;

use App\Models\Assets\Bond;
use App\Models\Assets\Crypto;
use Illuminate\Support\Carbon;

class CryptoDTO
{
    private Crypto $crypto;

    public function __construct(Crypto $crypto)
    {
        $this->crypto = $crypto;
    }

    /**
     * @return Crypto
     */
    public function getCrypto(): Crypto
    {
        return $this->crypto;
    }

    /**
     * @return string
     */
    public function getTicker(): string
    {
       return $this->crypto->ticker;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->crypto->name;
    }

    /**
     * @return float
     */
    public function getLots(): float
    {
        return $this->crypto->lots;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->crypto->price;
    }

    /**
     * @return float
     */
    public function getTotalPrice(): float
    {
        return $this->crypto->total_price;
    }
}
