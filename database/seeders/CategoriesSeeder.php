<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Categories;
class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Electronics',
                'slug' => 'electronics',
                'image' => 'categories/image/1737703204.webp',
                'created_at' => Carbon::parse('2025-01-24 07:20:04'),
                'updated_at' => Carbon::parse('2025-01-24 07:20:04'),
            ],
            [
                'name' => 'Fashion',
                'slug' => 'fashion',
                'image' => 'categories/image/1737704210.webp',
                'created_at' => Carbon::parse('2025-01-24 07:36:50'),
                'updated_at' => Carbon::parse('2025-01-24 07:36:50'),
            ],
            [
                'name' => 'Sports & Outdoors',
                'slug' => 'sports-outdoors',
                'image' => 'categories/image/1737704330.jpg',
                'created_at' => Carbon::parse('2025-01-24 07:38:50'),
                'updated_at' => Carbon::parse('2025-01-24 07:38:50'),
            ],
            [
                'name' => 'Books & Stationery',
                'slug' => 'books-stationery',
                'image' => 'categories/image/1737704592.webp',
                'created_at' => Carbon::parse('2025-01-24 07:43:12'),
                'updated_at' => Carbon::parse('2025-01-24 07:43:12'),
            ],
            [
                'name' => 'Automotive',
                'slug' => 'automotive',
                'image' => 'categories/image/1737704688.jpeg',
                'created_at' => Carbon::parse('2025-01-24 07:44:48'),
                'updated_at' => Carbon::parse('2025-01-24 07:44:48'),
            ],
            [
                'name' => 'Groceries & Food',
                'slug' => 'groceries-food',
                'image' => 'categories/image/1737704781.webp',
                'created_at' => Carbon::parse('2025-01-24 07:46:21'),
                'updated_at' => Carbon::parse('2025-01-24 07:46:21'),
            ],
            [
                'name' => 'Home & Kitchen',
                'slug' => 'home-appliances',
                'image' => 'categories/image/1737978884.jpg',
                'created_at' => Carbon::parse('2025-01-27 11:54:44'),
                'updated_at' => Carbon::parse('2025-01-27 11:54:44'),
            ],
            [
                'name' => 'Beauty & Personal Care',
                'slug' => 'beauty-personal-care',
                'image' => 'categories/image/1737979041.jpg',
                'created_at' => Carbon::parse('2025-01-27 11:57:21'),
                'updated_at' => Carbon::parse('2025-01-27 11:57:21'),
            ]
        ];
        DB::table('categories')->insert($categories);
    }
}
