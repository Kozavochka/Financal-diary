<?php

namespace App\Services\Assets;

use Illuminate\Support\Collection;

interface AssetsServiceContract
{
    public function getAssetsWithPriceCollection(): Collection;

    public function getDirectionsWithTotalPrice(): array;

    public function getAssetsTotalPrice(): float;
}
