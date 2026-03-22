<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Product::insert([
            [
                'name' => 'Whey Protein Isolate',
                'description' => 'Premium chocolate flavored whey protein isolate for muscle recovery.',
                'price' => 59.99,
                'stock' => 50,
                'category' => 'Proteins',
                'image' => 'https://images.unsplash.com/photo-1579722822506-c4729f95c63d?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'BCAA Energy Powder',
                'description' => 'Essential amino acids with natural caffeine for pre-workout energy.',
                'price' => 34.50,
                'stock' => 45,
                'category' => 'Amino Acids',
                'image' => 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Multi-Vitamin Sport',
                'description' => 'Daily vitamin pack specially formulated for athletes.',
                'price' => 24.99,
                'stock' => 100,
                'category' => 'Vitamins',
                'image' => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Creatine Monohydrate',
                'description' => 'Pure micronized creatine monohydrate for strength and size.',
                'price' => 29.99,
                'stock' => 60,
                'category' => 'Creatine',
                'image' => 'https://images.unsplash.com/photo-1593095948071-474c5cc2989d?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Pre-Workout Blast',
                'description' => 'High intensity pre-workout formula for extreme focus and pump.',
                'price' => 39.99,
                'stock' => 40,
                'category' => 'Pre-Workout',
                'image' => 'https://images.unsplash.com/photo-1623914878598-c11dfc282ce1?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Omega-3 Fish Oil',
                'description' => 'High potency EPA/DHA fish oil softgels.',
                'price' => 19.99,
                'stock' => 80,
                'category' => 'Vitamins',
                'image' => 'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
