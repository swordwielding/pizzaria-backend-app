<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    public function run()
    {
        $tags = [
            'Spicy',
            'Vegetarian',
            'Gluten-Free',
            'Cheesy',
            'Popular',
        ];

        foreach ($tags as $name) {
            Tag::create(['name' => $name]);
        }
    }
}
