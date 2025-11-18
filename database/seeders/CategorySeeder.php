<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            'Pizza',
            'Snack',
            'Dessert',
            'Drink',
        ];

        foreach ($categories as $name) {
            Category::create(['name' => $name]);
        }
    }
}
