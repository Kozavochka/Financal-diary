<?php

namespace Database\Seeders;

use App\Models\IncomeType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IncomeTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        IncomeType::query()
            ->create([
                'name' => 'Пополнение'
            ]);

        IncomeType::query()
            ->create([
                'name' => 'Дивиденды'
            ]);

        IncomeType::query()
            ->create([
                'name' => 'Перевод'
            ]);
    }
}
