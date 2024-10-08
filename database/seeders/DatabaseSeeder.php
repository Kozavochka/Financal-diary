<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(DirectionSeeder::class);
        $this->call(IndustrySeeder::class);
        $this->call(SettingsSeeder::class);
        $this->call(IncomeTypeSeeder::class);
        $this->call(CurrencyTypeSeeder::class);
        $this->call(UserSeeder::class);
    }
}
