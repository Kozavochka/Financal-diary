<?php

namespace Database\Seeders;

use App\Models\Direction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DirectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Direction::query()
            ->updateOrCreate([
               'name' => 'Акции'
            ]);

        Direction::query()
            ->updateOrCreate([
                'name' => 'Облигации'
            ]);

        Direction::query()
            ->updateOrCreate([
                'name' => 'Фонды'
            ]);

        Direction::query()
            ->updateOrCreate([
                'name' => 'Криптовалюта'
            ]);

        Direction::query()
            ->updateOrCreate([
                'name' => 'Займы'
            ]);

        Direction::query()
            ->updateOrCreate([
                'name' => 'Вклады'
            ]);

        Direction::query()
            ->updateOrCreate([
                'name' => 'Валюта'
            ]);
    }
}
