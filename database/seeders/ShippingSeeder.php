<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ShippingSeeder extends Seeder
{
    private array $shippings = [
        ['name' => 'next day delivery', 'price' => 4.99],
        ['name' => 'standart delivery', 'price' => 1.99],
        ['name' => 'personal pickup', 'price' => 0]
    ];

    public function run(): void
    {
        foreach ($this->shippings as $shipping)
        {
            DB::table('shippings')->insert($shipping);
        }
    }
}
