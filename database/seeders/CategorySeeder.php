<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $categories = [
            ['name' => 'Minuman', 'image' => 'minuman.png'],
            ['name' => 'Mie', 'image' => 'Makanan.png'],
            ['name' => 'Snack', 'image' => 'snack.png'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
