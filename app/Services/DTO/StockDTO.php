<?php

namespace App\Services\DTO;

use App\Models\Assets\Stock;

class StockDTO
{
    private Stock $stock;

    public function __construct(Stock $stock)
    {
        $this->stock = $stock;
    }

    /**
     * @return Stock
     */
    public function getStock(): Stock
    {
        return $this->stock;
    }

    /**
     * @return string
     */
    public function getStockTicker(): string
    {
       return $this->stock->ticker;
    }

    /**
     * @return string
     */
    public function getStockName(): string
    {
        return $this->stock->name;
    }

    /**
     * @return float
     */
    public function getStockLots(): float
    {
        return $this->stock->lots;
    }

    /**
     * @return float
     */
    public function getStockPrice(): float
    {
        return $this->stock->price;
    }

    /**
     * @return float
     */
    public function getStockTotalPrice(): float
    {
        return $this->stock->total_price;
    }

    /**
     * @return string
     */
    public function getStockIndustryName(): string
    {
        return $this->stock->industry?->name;
    }
}
