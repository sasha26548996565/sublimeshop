<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProvinceSeeder extends Seeder
{
    private array $provinces = [['name' => 'florida'], ['name' => 'kolorado'], ['name' => 'pittsubrgh']];

    public function run(): void
    {
        foreach ($this->provinces as $province)
        {
            DB::table('provinces')->insert($province);
        }
    }
}
