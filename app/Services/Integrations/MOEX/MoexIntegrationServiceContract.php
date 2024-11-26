<?php

namespace App\Services\Integrations\MOEX;

interface MoexIntegrationServiceContract
{
    public function getUsdLastPrice(): float;

    public function getStockPrice(string $ticker): float;
}
