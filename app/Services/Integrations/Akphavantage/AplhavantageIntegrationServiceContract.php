<?php

namespace App\Services\Integrations\Akphavantage;

interface AplhavantageIntegrationServiceContract
{
    public function getCryptoPrice(string $ticker): float|string;
}
