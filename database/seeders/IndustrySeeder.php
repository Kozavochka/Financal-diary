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
            ->updateOrCreate([
               'name' => 'Финансы'
            ]);

        Industry::query()
            ->updateOrCreate([
                'name' => 'Нефть и газ'
            ]);

        Industry::query()
            ->updateOrCreate([
                'name' => 'Сырьё'
            ]);

        Industry::query()
            ->updateOrCreate([
                'name' => 'Химпром'
            ]);

        Industry::query()
            ->updateOrCreate([
                'name' => 'Продовольствие'
            ]);

        Industry::query()
            ->updateOrCreate([
                'name' => 'Транспортный'
            ]);

        Industry::query()
            ->updateOrCreate([
                'name' => 'IT'
            ]);
    }
}
