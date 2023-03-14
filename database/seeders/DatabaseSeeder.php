<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $currentTime = Carbon::now()->toDateTimeString();

        $products = [
            [
                'name' => 'Pioneer DJ Mixer',
                'price' => 699,
                'created_at' =>$currentTime,
                'updated_at' =>$currentTime,
            ],
            [
                'name' => 'Roland Wave Sampler',
                'price' => 485,
                'created_at' =>$currentTime,
                'updated_at' =>$currentTime,
            ],
            [
                'name' => 'Reloop Headphone',
                'price' => 159,
                'created_at' =>$currentTime,
                'updated_at' =>$currentTime,
            ],
            [
                'name' => 'Rokit Monitor',
                'price' => 189.9,
                'created_at' =>$currentTime,
                'updated_at' =>$currentTime,
            ],
            [
                'name' => 'Fisherprice Baby Mixer',
                'price' => 120,
                'created_at' =>$currentTime,
                'updated_at' =>$currentTime,
            ]
        ];

        Product::insert($products);
    }
}
