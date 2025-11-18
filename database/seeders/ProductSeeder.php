<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $categories = Category::all();
        $tags = Tag::all();

        // 10 пицц
        $pizzas = [
            ['name' => 'Pepperoni', 'description' => 'Spicy pepperoni with cheese', 'price' => 800.00, 'image' => 'products/pepperoni.jpg'],
            ['name' => 'Margherita', 'description' => 'Classic pizza with tomato and mozzarella', 'price' => 900.00, 'image' => 'products/margherita.jpg'],
            ['name' => 'Hawaiian', 'description' => 'Ham and pineapple', 'price' => 780.00, 'image' => 'products/hawaiian.jpg'],
            ['name' => 'Veggie', 'description' => 'Fresh vegetables and cheese', 'price' => 950.00, 'image' => 'products/veggie.jpg'],
            ['name' => 'BBQ Chicken', 'description' => 'Chicken with BBQ sauce', 'price' => 350.00, 'image' => 'products/bbq_chicken.jpg'],
            ['name' => 'Four Cheese', 'description' => 'Mozzarella, cheddar, parmesan, gorgonzola', 'price' => 640.00, 'image' => 'products/four_cheese.jpg'],
            ['name' => 'Meat Lovers', 'description' => 'Ham, sausage, bacon', 'price' => 800.00, 'image' => 'products/meat_lovers.jpg'],
            ['name' => 'Seafood', 'description' => 'Shrimps and calamari', 'price' => 790.00, 'image' => 'products/seafood.jpg'],
            ['name' => 'Mushroom', 'description' => 'Fresh mushrooms and cheese', 'price' => 500.00, 'image' => 'products/mushroom.jpg'],
            ['name' => 'Spicy Italian', 'description' => 'Italian sausage and hot peppers', 'price' => 900.00, 'image' => 'products/spicy_italian.jpg'],
            ['name' => 'unknow', 'description' => 'unknow', 'price' => 1000.00, 'image' => 'products/unknow.jpg', 'is_available' => false],
        ];

        foreach ($pizzas as $item) {
            $product = Product::create([
                'name' => $item['name'],
                'description' => $item['description'],
                'price' => $item['price'],
                'image' => $item['image'],
                'category_id' => $categories->where('name', 'Pizza')->first()->id,
                'slug' => Str::slug($item['name']),
                'is_available' => $item['is_available'] ?? true,
            ]);
            
            $product->tags()->attach($tags->random(rand(1, 3))->pluck('id'));
        }

        // 4 снека
        $snacks = [
            ['name' => 'Garlic Bread', 'description' => 'Toasted bread with garlic', 'price' => 300.00, 'image' => 'products/garlic_bread.jpg'],
            ['name' => 'French Fries', 'description' => 'Crispy fries', 'price' => 200.00, 'image' => 'products/fries.jpg'],
            ['name' => 'Chicken Wings', 'description' => 'Spicy wings', 'price' => 500.00, 'image' => 'products/wings.jpg'],
            ['name' => 'Mozzarella Sticks', 'description' => 'Fried cheese sticks', 'price' => 400.00, 'image' => 'products/mozzarella_sticks.jpg'],
        ];

        foreach ($snacks as $item) {
            $product = Product::create([
                'name' => $item['name'],
                'description' => $item['description'],
                'price' => $item['price'],
                'image' => $item['image'],
                'category_id' => $categories->where('name', 'Snack')->first()->id,
                'slug' => Str::slug($item['name']),
                'is_available' => true,
            ]);
            $product->tags()->attach($tags->random(rand(1, 2))->pluck('id'));
        }

        // 5 десертов
        $desserts = [
            ['name' => 'Chocolate Cake', 'description' => 'Rich chocolate cake', 'price' => 400.00, 'image' => 'products/chocolate_cake.jpg'],
            ['name' => 'Tiramisu', 'description' => 'Classic Italian dessert', 'price' => 500.00, 'image' => 'products/tiramisu.jpg'],
            ['name' => 'Ice Cream', 'description' => 'Vanilla ice cream', 'price' => 300.00, 'image' => 'products/ice_cream.jpg'],
            ['name' => 'Cheesecake', 'description' => 'Creamy cheesecake', 'price' => 550.00, 'image' => 'products/cheesecake.jpg'],
            ['name' => 'Brownie', 'description' => 'Chocolate brownie', 'price' => 350.00, 'image' => 'products/brownie.jpg'],
        ];

        foreach ($desserts as $item) {
            $product = Product::create([
                'name' => $item['name'],
                'description' => $item['description'],
                'price' => $item['price'],
                'image' => $item['image'],
                'category_id' => $categories->where('name', 'Dessert')->first()->id,
                'slug' => Str::slug($item['name']),
                'is_available' => true,
            ]);
            $product->tags()->attach($tags->random(1)->pluck('id'));
        }

        // 2 напитка
        $drinks = [
            ['name' => 'Coca-Cola', 'description' => 'Refreshing soda', 'price' => 150.00, 'image' => 'products/coca_cola.jpg'],
            ['name' => 'Orange Juice', 'description' => 'Freshly squeezed', 'price' => 200.00, 'image' => 'products/orange_juice.jpg'],
        ];

        foreach ($drinks as $item) {
            $product = Product::create([
                'name' => $item['name'],
                'description' => $item['description'],
                'price' => $item['price'],
                'image' => $item['image'],
                'category_id' => $categories->where('name', 'Drink')->first()->id,
                'slug' => Str::slug($item['name']),
                'is_available' => true,
            ]);
            $product->tags()->attach($tags->random(1)->pluck('id'));
        }
    }
}