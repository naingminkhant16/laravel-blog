<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $titles = ['sport', 'IT news', 'entertainment', 'tarvel', 'food & drinks'];
        foreach ($titles as $title) {
            Category::factory()->create([
                'title' => $title,
                'slug' => Str::slug($title),
                'user_id' => User::inRandomOrder()->first()->id,
            ]);
        }
    }
}
