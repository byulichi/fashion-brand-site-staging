<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('items')->insert([
        // Scarves
        ['type_id' => 1, 'name' => 'Autumn Breeze Scarf', 'price' => 79.00, 'photo' => null],
        ['type_id' => 1, 'name' => 'Winter Wonderland Scarf', 'price' => 89.00, 'photo' => null],
        ['type_id' => 1, 'name' => 'Summer Sunset Scarf', 'price' => 69.00, 'photo' => null],
        ['type_id' => 1, 'name' => 'Spring Blossom Scarf', 'price' => 75.00, 'photo' => null],
        ['type_id' => 1, 'name' => 'Golden Hour Scarf', 'price' => 85.00, 'photo' => null],
        ['type_id' => 1, 'name' => 'Moonlight Glow Scarf', 'price' => 95.00, 'photo' => null],
        ['type_id' => 1, 'name' => 'Starlight Scarf', 'price' => 99.00, 'photo' => null],
        ['type_id' => 1, 'name' => 'Rose Petal Scarf', 'price' => 89.00, 'photo' => null],
        ['type_id' => 1, 'name' => 'Ocean Wave Scarf', 'price' => 79.00, 'photo' => null],
        ['type_id' => 1, 'name' => 'Crimson Tide Scarf', 'price' => 85.00, 'photo' => null],

        // Ready to Wear
        ['type_id' => 2, 'name' => 'Classic Blouse', 'price' => 159.00, 'photo' => null],
        ['type_id' => 2, 'name' => 'Modern Tunic', 'price' => 179.00, 'photo' => null],
        ['type_id' => 2, 'name' => 'Elegant Dress', 'price' => 249.00, 'photo' => null],
        ['type_id' => 2, 'name' => 'Casual Shirt', 'price' => 99.00, 'photo' => null],
        ['type_id' => 2, 'name' => 'Formal Jacket', 'price' => 299.00, 'photo' => null],
        ['type_id' => 2, 'name' => 'Summer Dress', 'price' => 189.00, 'photo' => null],
        ['type_id' => 2, 'name' => 'Winter Coat', 'price' => 399.00, 'photo' => null],
        ['type_id' => 2, 'name' => 'Linen Pants', 'price' => 129.00, 'photo' => null],
        ['type_id' => 2, 'name' => 'Silk Blouse', 'price' => 199.00, 'photo' => null],
        ['type_id' => 2, 'name' => 'Evening Gown', 'price' => 349.00, 'photo' => null],

        // Bags
        ['type_id' => 3, 'name' => 'Leather Handbag', 'price' => 299.00, 'photo' => null],
        ['type_id' => 3, 'name' => 'Canvas Tote', 'price' => 129.00, 'photo' => null],
        ['type_id' => 3, 'name' => 'Classic Satchel', 'price' => 249.00, 'photo' => null],
        ['type_id' => 3, 'name' => 'Designer Clutch', 'price' => 199.00, 'photo' => null],
        ['type_id' => 3, 'name' => 'Travel Backpack', 'price' => 179.00, 'photo' => null],
        ['type_id' => 3, 'name' => 'Crossbody Bag', 'price' => 149.00, 'photo' => null],
        ['type_id' => 3, 'name' => 'Mini Shoulder Bag', 'price' => 99.00, 'photo' => null],
        ['type_id' => 3, 'name' => 'Evening Bag', 'price' => 189.00, 'photo' => null],
        ['type_id' => 3, 'name' => 'Casual Messenger Bag', 'price' => 139.00, 'photo' => null],
        ['type_id' => 3, 'name' => 'Luxury Handbag', 'price' => 499.00, 'photo' => null],

        // Shoes
        ['type_id' => 4, 'name' => 'Classic Loafers', 'price' => 199.00, 'photo' => null],
        ['type_id' => 4, 'name' => 'Summer Sandals', 'price' => 99.00, 'photo' => null],
        ['type_id' => 4, 'name' => 'Formal Oxfords', 'price' => 249.00, 'photo' => null],
        ['type_id' => 4, 'name' => 'Casual Sneakers', 'price' => 129.00, 'photo' => null],
        ['type_id' => 4, 'name' => 'Winter Boots', 'price' => 299.00, 'photo' => null],
        ['type_id' => 4, 'name' => 'Running Shoes', 'price' => 179.00, 'photo' => null],
        ['type_id' => 4, 'name' => 'High Heels', 'price' => 159.00, 'photo' => null],
        ['type_id' => 4, 'name' => 'Ankle Boots', 'price' => 229.00, 'photo' => null],
        ['type_id' => 4, 'name' => 'Moccasins', 'price' => 139.00, 'photo' => null],
        ['type_id' => 4, 'name' => 'Luxury Dress Shoes', 'price' => 399.00, 'photo' => null],

        // Accessories
        ['type_id' => 5, 'name' => 'Gold Necklace', 'price' => 299.00, 'photo' => null],
        ['type_id' => 5, 'name' => 'Silver Bracelet', 'price' => 159.00, 'photo' => null],
        ['type_id' => 5, 'name' => 'Leather Belt', 'price' => 99.00, 'photo' => null],
        ['type_id' => 5, 'name' => 'Pearl Earrings', 'price' => 189.00, 'photo' => null],
        ['type_id' => 5, 'name' => 'Designer Sunglasses', 'price' => 249.00, 'photo' => null],
        ['type_id' => 5, 'name' => 'Silk Scarf', 'price' => 129.00, 'photo' => null],
        ['type_id' => 5, 'name' => 'Wool Hat', 'price' => 79.00, 'photo' => null],
        ['type_id' => 5, 'name' => 'Cashmere Gloves', 'price' => 149.00, 'photo' => null],
        ['type_id' => 5, 'name' => 'Luxury Watch', 'price' => 599.00, 'photo' => null],
        ['type_id' => 5, 'name' => 'Crystal Brooch', 'price' => 89.00, 'photo' => null],

        // Leena suit
        ['type_id' => 6, 'name' => 'IMG_0223', 'price' => 109.00, 'photo' => 'images/Leena_suit/IMG_0223.JPG'],
        ['type_id' => 6, 'name' => 'IMG_0230', 'price' => 109.00, 'photo' => 'images/Leena_suit/IMG_0230.JPG'],
        ['type_id' => 6, 'name' => 'IMG_0232', 'price' => 109.00, 'photo' => 'images/Leena_suit/IMG_0232.JPG'],
        ['type_id' => 6, 'name' => 'IMG_0233', 'price' => 109.00, 'photo' => 'images/Leena_suit/IMG_0233.JPG'],
        ['type_id' => 6, 'name' => 'IMG_0242', 'price' => 109.00, 'photo' => 'images/Leena_suit/IMG_0242.JPG'],
        ['type_id' => 6, 'name' => 'IMG_0254', 'price' => 109.00, 'photo' => 'images/Leena_suit/IMG_0254.JPG'],
        ['type_id' => 6, 'name' => 'IMG_0282', 'price' => 109.00, 'photo' => 'images/Leena_suit/IMG_0282.JPG'],
        ['type_id' => 6, 'name' => 'IMG_0283', 'price' => 109.00, 'photo' => 'images/Leena_suit/IMG_0283.JPG'],
        ['type_id' => 6, 'name' => 'IMG_0290', 'price' => 109.00, 'photo' => 'images/Leena_suit/IMG_0290.JPG'],
        ['type_id' => 6, 'name' => 'IMG_0291', 'price' => 109.00, 'photo' => 'images/Leena_suit/IMG_0291.JPG'],
        ['type_id' => 6, 'name' => 'IMG_0297', 'price' => 109.00, 'photo' => 'images/Leena_suit/IMG_0297.JPG'],
        ['type_id' => 6, 'name' => 'IMG_0311', 'price' => 109.00, 'photo' => 'images/Leena_suit/IMG_0311.JPG'],
        ['type_id' => 6, 'name' => 'IMG_0373', 'price' => 109.00, 'photo' => 'images/Leena_suit/IMG_0373.JPG'],

        // Tasneem suit
        ['type_id' => 7, 'name' => 'IMG_1501', 'price' => 109.00, 'photo' => 'images/Tasneem_suit/IMG_1501.JPG'],
        ['type_id' => 7, 'name' => 'IMG_1502', 'price' => 109.00, 'photo' => 'images/Tasneem_suit/IMG_1502.JPG'],
        ['type_id' => 7, 'name' => 'IMG_1510', 'price' => 109.00, 'photo' => 'images/Tasneem_suit/IMG_1510.JPG'],
        ['type_id' => 7, 'name' => 'IMG_1512', 'price' => 109.00, 'photo' => 'images/Tasneem_suit/IMG_1512.JPG'],
        ['type_id' => 7, 'name' => 'IMG_1514', 'price' => 109.00, 'photo' => 'images/Tasneem_suit/IMG_1514.JPG'],
        ['type_id' => 7, 'name' => 'IMG_1515', 'price' => 109.00, 'photo' => 'images/Tasneem_suit/IMG_1515.JPG'],
        ['type_id' => 7, 'name' => 'IMG_1516', 'price' => 109.00, 'photo' => 'images/Tasneem_suit/IMG_1516.JPG'],
        ]);
    }
}
