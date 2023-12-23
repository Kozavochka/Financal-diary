<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use App\Services\DTO\SettingsDTO;


class SettingsController extends Controller
{
    public function index()
    {
        $settings = collect();

        foreach (Settings::all() as $setting){
                $settings->push(new SettingsDTO($setting));
        }

        return view('settings.index',compact('settings'));
    }
}
