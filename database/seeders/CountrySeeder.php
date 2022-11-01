<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    private array $countries = [['name' => 'USA'], ['name' => 'russia']];

    public function run(): void
    {
        foreach ($this->countries as $country)
        {
            DB::table('countries')->insert($country);
        }
    }
}
