<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CitySeeder extends Seeder
{
    private array $cities = [['name' => 'washington'], ['name' => 'edmonton'], ['name' => 'toronto']];

    public function run(): void
    {
        foreach ($this->cities as $city)
        {
            DB::table('cities')->insert($city);
        }
    }
}
