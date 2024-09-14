<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use App\Services\Api\Finance\PriceCurrencyHelper;
use App\Services\Assets\AssetsServiceContract;
use App\Services\DTO\SettingsDTO;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;


class SettingsController extends Controller
{
    protected $assetsService;

    public function __construct(AssetsServiceContract $assetsService)
    {
        $this->assetsService = $assetsService;
    }

    public function index()
    {
        $settings = collect();

        foreach (Settings::query()->orderBy('id')->get() as $setting) {
                $settings->push(new SettingsDTO($setting));
        }

        return view('settings.index', compact('settings'));
    }

    public function updateUsdPrice()
    {
        DB::beginTransaction();
        try {

            Cache::tags(['usd'])
                ->flush();

            Settings::query()
                ->where('key','usd_price')
                ->update([
                    'value' => ['price' => round(PriceCurrencyHelper::getUSDPrice(),2)]
                ]);
        }
        catch (\Exception $exception){
            DB::rollBack();
            abort(500);
        }
        DB::commit();

        return redirect()->back();
    }

    public function updateTotalPrice()
    {
        DB::beginTransaction();
        try {

            Cache::delete('total_price');

            Settings::query()
                ->where('key','total_price')
                ->update([
                    'value' => ['price' => $this->assetsService->getAssetsTotalPrice()]
                ]);
        }
        catch (\Exception $exception){
            DB::rollBack();
            abort(500);
        }
        DB::commit();

        return redirect()->back();
    }
}
