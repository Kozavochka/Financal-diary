<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use App\Services\Api\Finance\PriceCurrencyHelper;
use App\Services\DTO\SettingsDTO;
use App\Services\Statistic\TotalStatisticServiceContract;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;


class SettingsController extends Controller
{
    protected $stastisticSerivce;

    public function __construct(TotalStatisticServiceContract $statisticService)
    {
        $this->stastisticSerivce = $statisticService;
    }

    public function index()
    {
        $settings = collect();

        foreach (Settings::all() as $setting){
                $settings->push(new SettingsDTO($setting));
        }

        return view('settings.index',compact('settings'));
    }

    public function updateUsdPrice()
    {
        DB::beginTransaction();
        try {
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
            Settings::query()
                ->where('key','total_price')
                ->update([
                    'value' => ['price' => $this->stastisticSerivce->getTotalSumForSetting()]
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
