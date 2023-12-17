<?php

namespace Database\Seeders;

use App\Models\Settings;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Settings::query()
            ->create([
                'key' => 'total_price',
                'value' => ['price' => 1]
            ]);

        Settings::query()
            ->create([
                'key' => 'usd_price',
                'value' => ['price' => 60]
            ]);
    }
}
