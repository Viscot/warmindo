<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        // Ambil kategori berdasarkan nama
        $minuman = Category::where('name', 'Minuman')->first();
        $snack = Category::where('name', 'Snack')->first();
        $mie = Category::where('name', 'Mie')->first();

        // Tambahkan menu untuk kategori Minuman
        Menu::create([
            'category_id' => $minuman->id,
            'name' => 'Es Teh',
            'image' => 'esteh.jpg',
            'description' => 'Es teh manis dingin',
            'price' => 5000,
            'status' => 'masih'
        ]);

        Menu::create([
            'category_id' => $minuman->id,
            'name' => 'Jus Jeruk',
            'image' => 'jus_jeruk.png',
            'description' => 'Jus jeruk segar',
            'price' => 8000,
            'status' => 'masih'
        ]);

        // Tambahkan menu untuk kategori Snack
        Menu::create([
            'category_id' => $snack->id,
            'name' => 'Keripik Kentang',
            'image' => 'keripik_kentang.jpg',
            'description' => 'Keripik kentang renyah',
            'price' => 10000,
            'status' => 'masih'
        ]);

        Menu::create([
            'category_id' => $snack->id,
            'name' => 'Kacang Goreng',
            'image' => 'kacang_goreng.jpg',
            'description' => 'Kacang goreng gurih',
            'price' => 7000,
            'status' => 'masih'
        ]);

        // Tambahkan menu untuk kategori Mie
        Menu::create([
            'category_id' => $mie->id,
            'name' => 'Mie Goreng',
            'image' => 'mie_goreng.jpg',
            'description' => 'Mie goreng spesial',
            'price' => 12000,
            'status' => 'masih'
        ]);

        Menu::create([
            'category_id' => $mie->id,
            'name' => 'Mie Rebus',
            'image' => 'mie_rebus.jpg',
            'description' => 'Mie rebus dengan kuah kaldu',
            'price' => 11000,
            'status' => 'masih'
        ]);
    }
}
