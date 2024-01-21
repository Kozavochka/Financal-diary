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
                'name' => 'Доллары США',
                'short_name' => 'USD'
            ]);

        CurrencyType::query()
            ->create([
                'name' => 'Китайские юани',
                'short_name' => 'CNY'
            ]);

        CurrencyType::query()
            ->create([
                'name' => 'Евро',
                'short_name' => 'EUR'
            ]);
    }
}
