<?php

namespace App\Services\DTO;

use App\Models\Settings;

class SettingsDTO
{
    protected $setting;

    public function __construct(Settings $setting)
    {
        $this->setting = $setting;
    }

    public function getSetting()
    {
        return $this->setting;
    }

    public function getKey()
    {
        return $this->setting->key;
    }

    public function getValue()
    {
        return $this->setting->value;
    }

    public function getValuePrice()
    {
        return $this->setting->value['price'];
    }
}
