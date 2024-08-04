<?php

namespace Database\Seeders;

use App\Models\CurrencyType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CurrencyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CurrencyType::query()
            ->updateOrCreate([
                'name' => 'Рубль',
                'ticker' => 'RUB'
            ]);

        CurrencyType::query()
            ->updateOrCreate([
                'name' => 'Доллар США',
                'ticker' => 'USD'
            ]);

        CurrencyType::query()
            ->updateOrCreate([
                'name' => 'Китайский юань',
                'ticker' => 'CNY'
            ]);

        CurrencyType::query()
            ->updateOrCreate([
                'name' => 'Евро',
                'ticker' => 'EUR'
            ]);
    }
}
