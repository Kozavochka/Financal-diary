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
            ->create([
               'name' => 'Акции'
            ]);

        Direction::query()
            ->create([
                'name' => 'Облигации'
            ]);

        Direction::query()
            ->create([
                'name' => 'Фонды'
            ]);

        Direction::query()
            ->create([
                'name' => 'Криптовалюта'
            ]);

        Direction::query()
            ->create([
                'name' => 'Займы'
            ]);
    }
}
