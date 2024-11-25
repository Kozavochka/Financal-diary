<?php

namespace App\Services\Integrations\ByBit;

interface ByBitIntegrationServiceContract
{
    public function getWalletInfo();

    public function syncCoins();
}
