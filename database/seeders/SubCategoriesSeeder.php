<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\SubCategory;
class SubCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subCategories = [
            [
                'name' => 'Cricket',
                'slug' => 'cricket',
                'description' => 'Cricket is a team sport that involves batting, bowling, and fielding.',
                'category_id' => 3,
                'image' => 'sub-categories/image/1737979170.webp',
                'created_at' => Carbon::parse('2025-01-27 11:59:30'),
                'updated_at' => Carbon::parse('2025-01-27 11:59:30'),
            ],
            [
                'name' => 'Basketball',
                'slug' => 'basketball',
                'description' => 'Basketball is a team sport where two teams of five players each try to score points by shooting a ball through the opponent’s hoop.',
                'category_id' => 3,
                'image' => 'sub-categories/image/1737979268.jpg',
                'created_at' => Carbon::parse('2025-01-27 12:01:08'),
                'updated_at' => Carbon::parse('2025-01-27 12:01:08'),
            ],
            [
                'name' => 'Hockey',
                'slug' => 'hockey',
                'description' => 'Hockey is a sport where two teams compete to score goals by hitting a puck or ball into the opponent’s goal.',
                'category_id' => 3,
                'image' => 'sub-categories/image/1737979497.webp',
                'created_at' => Carbon::parse('2025-01-27 12:04:57'),
                'updated_at' => Carbon::parse('2025-01-27 12:04:57'),
            ],
            [
                'name' => 'Mobile Devices',
                'slug' => 'mobile-devices',
                'description' => 'A mobile device is a small, portable computer that allows users to access data and services.',
                'category_id' => 1,
                'image' => 'sub-categories/image/1737980423.webp',
                'created_at' => Carbon::parse('2025-01-27 12:20:23'),
                'updated_at' => Carbon::parse('2025-01-27 12:20:23'),
            ],
            [
                'name' => 'Home Appliances',
                'slug' => 'home-appliances',
                'description' => 'Home appliances are devices that help with household functions such as cooking, cleaning, and food preservation.',
                'category_id' => 1,
                'image' => 'sub-categories/image/1737980548.jpg',
                'created_at' => Carbon::parse('2025-01-27 12:22:28'),
                'updated_at' => Carbon::parse('2025-01-27 12:22:28'),
            ],
            [
                'name' => 'Computers',
                'slug' => 'computers',
                'description' => 'A computer is an electronic device that processes data and performs tasks according to instructions.',
                'category_id' => 1,
                'image' => 'sub-categories/image/1737980625.jpg',
                'created_at' => Carbon::parse('2025-01-27 12:23:45'),
                'updated_at' => Carbon::parse('2025-01-27 12:23:45'),
            ],
            [
                'name' => 'Clothing',
                'slug' => 'clothing',
                'description' => 'Clothing is a category of garments worn by individuals to cover their body and provide protection from the elements.',
                'category_id' => 2,
                'image' => 'sub-categories/image/1737980716.jpg',
                'created_at' => Carbon::parse('2025-01-27 12:25:16'),
                'updated_at' => Carbon::parse('2025-01-27 12:25:16'),
            ],
            [
                'name' => 'Footwear',
                'slug' => 'footwear',
                'description' => 'Footwear is a type of clothing that covers the feet to provide protection and comfort.',
                'category_id' => 2,
                'image' => 'sub-categories/image/1737980846.jpg',
                'created_at' => Carbon::parse('2025-01-27 12:27:26'),
                'updated_at' => Carbon::parse('2025-01-27 12:27:26'),
            ],
            [
                'name' => 'Accessories',
                'slug' => 'accessories',
                'description' => 'Fashion accessories are items that are worn or carried to complement an outfit.',
                'category_id' => 2,
                'image' => 'sub-categories/image/1737980941.jpg',
                'created_at' => Carbon::parse('2025-01-27 12:29:01'),
                'updated_at' => Carbon::parse('2025-01-27 12:29:01'),
            ],
            [
                'name' => 'Beauty & Cosmetics',
                'slug' => 'beauty-cosmetics',
                'description' => 'Beauty & Cosmetics refers to products used to enhance or alter a person’s appearance.',
                'category_id' => 2,
                'image' => 'sub-categories/image/1737981079.jpg',
                'created_at' => Carbon::parse('2025-01-27 12:31:19'),
                'updated_at' => Carbon::parse('2025-01-27 12:31:19'),
            ],
            [
                'name' => 'Books',
                'slug' => 'books',
                'description' => 'A book description is a summary of a book\'s content, its themes, characters, and overall essence.',
                'category_id' => 4,
                'image' => 'sub-categories/image/1737981147.jpg',
                'created_at' => Carbon::parse('2025-01-27 12:32:27'),
                'updated_at' => Carbon::parse('2025-01-27 12:32:27'),
            ],
            [
                'name' => 'Stationery',
                'slug' => 'stationery',
                'description' => 'Stationery refers to writing materials and office supplies used for writing, printing, and organizing.',
                'category_id' => 4,
                'image' => 'sub-categories/image/1737981209.jpg',
                'created_at' => Carbon::parse('2025-01-27 12:33:29'),
                'updated_at' => Carbon::parse('2025-01-27 12:33:29'),
            ],
            [
                'name' => 'Art & Craft Supplies',
                'slug' => 'art-craft-supplies',
                'description' => 'Art and craft supplies are materials used to create artworks and handmade items.',
                'category_id' => 4,
                'image' => 'sub-categories/image/1737981258.jpg',
                'created_at' => Carbon::parse('2025-01-27 12:34:18'),
                'updated_at' => Carbon::parse('2025-01-27 12:34:18'),
            ],
            [
                'name' => 'Vehicle Types',
                'slug' => 'vehicle-types',
                'description' => 'Vehicle types refer to the different categories of vehicles, such as cars, trucks, and motorcycles.',
                'category_id' => 5,
                'image' => 'sub-categories/image/1737981324.jpg',
                'created_at' => Carbon::parse('2025-01-27 12:35:24'),
                'updated_at' => Carbon::parse('2025-01-27 12:35:24'),
            ],
            [
                'name' => 'Car Parts & Accessories',
                'slug' => 'car-parts-accessories',
                'description' => 'Car parts and accessories are the components and accessories that enhance or repair a vehicle.',
                'category_id' => 5,
                'image' => 'sub-categories/image/1737981399.jpg',
                'created_at' => Carbon::parse('2025-01-27 12:36:39'),
                'updated_at' => Carbon::parse('2025-01-27 12:36:39'),
            ],
            [
                'name' => 'Fresh Food',
                'slug' => 'fresh-food',
                'description' => 'Fresh Food refers to unprocessed food that has not been frozen, canned, or processed in any way.',
                'category_id' => 6,
                'image' => 'sub-categories/image/1737981474.jpg',
                'created_at' => Carbon::parse('2025-01-27 12:37:54'),
                'updated_at' => Carbon::parse('2025-01-27 12:37:54'),
            ],
            [
                'name' => 'Bakery',
                'slug' => 'bakery',
                'description' => 'A bakery is a place that makes and sells baked goods like bread, cakes, and pastries.',
                'category_id' => 6,
                'image' => 'sub-categories/image/1737981527.jpg',
                'created_at' => Carbon::parse('2025-01-27 12:38:47'),
                'updated_at' => Carbon::parse('2025-01-27 12:38:47'),
            ],
            [
                'name' => 'Furniture',
                'slug' => 'furniture',
                'description' => 'Furniture is a collection of objects used to support various human activities, such as seating, eating, and sleeping.',
                'category_id' => 7,
                'image' => 'sub-categories/image/1737981750.jpg',
                'created_at' => Carbon::parse('2025-01-27 12:42:30'),
                'updated_at' => Carbon::parse('2025-01-27 12:42:30'),
            ],
            [
                'name' => 'Skincare',
                'slug' => 'skincare',
                'description' => 'Skincare is the practice of keeping your skin healthy and nourished.',
                'category_id' => 8,
                'image' => 'sub-categories/image/1737981823.jpg',
                'created_at' => Carbon::parse('2025-01-27 12:43:43'),
                'updated_at' => Carbon::parse('2025-01-27 12:43:43'),
            ]
        ];
        DB::table('sub_categories')->insert($subCategories);
    }
}
