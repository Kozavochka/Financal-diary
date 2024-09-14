<?php

namespace App\Services\Settings;

use App\Models\Settings;
use Illuminate\Support\Facades\Cache;

class SettingsHelper
{
    const CACHE_TTL = 60 * 60;

    public static function getUSDPriceFromSetting()
    {
        return Cache::tags(['settings','usd'])
            ->remember('usd_price_setting', self::CACHE_TTL,  function() {
               return  Settings::query()
                   ->where('key','usd_price')
                   ->first()?->value['price'] ?? 0;
            });

    }
}
