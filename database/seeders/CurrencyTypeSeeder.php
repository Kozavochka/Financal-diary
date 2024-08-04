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
            ->create([
                'name' => 'Рубль',
                'ticker' => 'RUB'
            ]);

        CurrencyType::query()
            ->create([
                'name' => 'Доллар США',
                'ticker' => 'USD'
            ]);

        CurrencyType::query()
            ->create([
                'name' => 'Китайский юань',
                'ticker' => 'CNY'
            ]);

        CurrencyType::query()
            ->create([
                'name' => 'Евро',
                'ticker' => 'EUR'
            ]);
    }
}
