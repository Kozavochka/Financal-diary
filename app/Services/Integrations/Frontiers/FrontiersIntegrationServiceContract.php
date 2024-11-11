<?php

namespace App\Services\Integrations\Frontiers;

interface FrontiersIntegrationServiceContract
{
    public function getToken();

    public function getBalanceInfo(): array;
}
