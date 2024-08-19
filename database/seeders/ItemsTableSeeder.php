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
        ['type_id' => 1, 'name' => 'Autumn Breeze Scarf', 'price' => 79.00],
        ['type_id' => 1, 'name' => 'Winter Wonderland Scarf', 'price' => 89.00],
        ['type_id' => 1, 'name' => 'Summer Sunset Scarf', 'price' => 69.00],
        ['type_id' => 1, 'name' => 'Spring Blossom Scarf', 'price' => 75.00],
        ['type_id' => 1, 'name' => 'Golden Hour Scarf', 'price' => 85.00],
        ['type_id' => 1, 'name' => 'Moonlight Glow Scarf', 'price' => 95.00],
        ['type_id' => 1, 'name' => 'Starlight Scarf', 'price' => 99.00],
        ['type_id' => 1, 'name' => 'Rose Petal Scarf', 'price' => 89.00],
        ['type_id' => 1, 'name' => 'Ocean Wave Scarf', 'price' => 79.00],
        ['type_id' => 1, 'name' => 'Crimson Tide Scarf', 'price' => 85.00],

        // Ready to Wear
        ['type_id' => 2, 'name' => 'Classic Blouse', 'price' => 159.00],
        ['type_id' => 2, 'name' => 'Modern Tunic', 'price' => 179.00],
        ['type_id' => 2, 'name' => 'Elegant Dress', 'price' => 249.00],
        ['type_id' => 2, 'name' => 'Casual Shirt', 'price' => 99.00],
        ['type_id' => 2, 'name' => 'Formal Jacket', 'price' => 299.00],
        ['type_id' => 2, 'name' => 'Summer Dress', 'price' => 189.00],
        ['type_id' => 2, 'name' => 'Winter Coat', 'price' => 399.00],
        ['type_id' => 2, 'name' => 'Linen Pants', 'price' => 129.00],
        ['type_id' => 2, 'name' => 'Silk Blouse', 'price' => 199.00],
        ['type_id' => 2, 'name' => 'Evening Gown', 'price' => 349.00],

        // Bags
        ['type_id' => 3, 'name' => 'Leather Handbag', 'price' => 299.00],
        ['type_id' => 3, 'name' => 'Canvas Tote', 'price' => 129.00],
        ['type_id' => 3, 'name' => 'Classic Satchel', 'price' => 249.00],
        ['type_id' => 3, 'name' => 'Designer Clutch', 'price' => 199.00],
        ['type_id' => 3, 'name' => 'Travel Backpack', 'price' => 179.00],
        ['type_id' => 3, 'name' => 'Crossbody Bag', 'price' => 149.00],
        ['type_id' => 3, 'name' => 'Mini Shoulder Bag', 'price' => 99.00],
        ['type_id' => 3, 'name' => 'Evening Bag', 'price' => 189.00],
        ['type_id' => 3, 'name' => 'Casual Messenger Bag', 'price' => 139.00],
        ['type_id' => 3, 'name' => 'Luxury Handbag', 'price' => 499.00],

        // Shoes
        ['type_id' => 4, 'name' => 'Classic Loafers', 'price' => 199.00],
        ['type_id' => 4, 'name' => 'Summer Sandals', 'price' => 99.00],
        ['type_id' => 4, 'name' => 'Formal Oxfords', 'price' => 249.00],
        ['type_id' => 4, 'name' => 'Casual Sneakers', 'price' => 129.00],
        ['type_id' => 4, 'name' => 'Winter Boots', 'price' => 299.00],
        ['type_id' => 4, 'name' => 'Running Shoes', 'price' => 179.00],
        ['type_id' => 4, 'name' => 'High Heels', 'price' => 159.00],
        ['type_id' => 4, 'name' => 'Ankle Boots', 'price' => 229.00],
        ['type_id' => 4, 'name' => 'Moccasins', 'price' => 139.00],
        ['type_id' => 4, 'name' => 'Luxury Dress Shoes', 'price' => 399.00],

        // Accessories
        ['type_id' => 5, 'name' => 'Gold Necklace', 'price' => 299.00],
        ['type_id' => 5, 'name' => 'Silver Bracelet', 'price' => 159.00],
        ['type_id' => 5, 'name' => 'Leather Belt', 'price' => 99.00],
        ['type_id' => 5, 'name' => 'Pearl Earrings', 'price' => 189.00],
        ['type_id' => 5, 'name' => 'Designer Sunglasses', 'price' => 249.00],
        ['type_id' => 5, 'name' => 'Silk Scarf', 'price' => 129.00],
        ['type_id' => 5, 'name' => 'Wool Hat', 'price' => 79.00],
        ['type_id' => 5, 'name' => 'Cashmere Gloves', 'price' => 149.00],
        ['type_id' => 5, 'name' => 'Luxury Watch', 'price' => 599.00],
        ['type_id' => 5, 'name' => 'Crystal Brooch', 'price' => 89.00],
        ]);
    }
}
