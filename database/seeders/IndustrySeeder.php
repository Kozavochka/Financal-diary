<?php

namespace Database\Seeders;

use App\Models\Industry;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IndustrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Industry::query()
            ->create([
               'name' => 'Финансы'
            ]);

        Industry::query()
            ->create([
                'name' => 'Нефть и газ'
            ]);

        Industry::query()
            ->create([
                'name' => 'Сырьё'
            ]);

        Industry::query()
            ->create([
                'name' => 'Химпром'
            ]);

        Industry::query()
            ->create([
                'name' => 'Продовольствие'
            ]);

        Industry::query()
            ->create([
                'name' => 'Транспортный'
            ]);

        Industry::query()
            ->create([
                'name' => 'IT'
            ]);
    }
}
