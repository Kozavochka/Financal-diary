<?php

namespace App\Services\Api\Finance;

use App\Services\Integrations\MOEX\MoexIntegrationServiceContract;
use Illuminate\Support\Facades\Cache;

class PriceCurrencyHelper
{
    const CACHE_TTL = 15 * 60;

    public static function getUSDPrice()
    {
        /** @var MoexIntegrationServiceContract $usdPriceService */
        $usdPriceService = app()->make(MoexIntegrationServiceContract::class);

        return Cache::tags(['currency','usd'])
            ->remember('usd_price', self::CACHE_TTL,  function() use($usdPriceService) {

                return $usdPriceService->getUsdLastPrice();
            });

    }
}
