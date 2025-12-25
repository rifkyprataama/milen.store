<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'Boneka Rajut',
            'slug' => 'boneka-rajut',
        ]);

        Category::create([
            'name' => 'Syal & Topi',
            'slug' => 'syal-dan-topi',
        ]);

        Category::create([
            'name' => 'Tas Handmade',
            'slug' => 'tas-handmade',
        ]);
    }
}
