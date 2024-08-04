<?php

namespace Database\Seeders;

use App\Models\Bank;
use Illuminate\Database\Seeder;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bank::query()
            ->updateOrCreate([
                'name' => 'Сбербанк',
            ]);

        Bank::query()
            ->updateOrCreate([
                'name' => 'ТБанк',
            ]);

        Bank::query()
            ->updateOrCreate([
                'name' => 'Альфабанк',
            ]);
    }
}
