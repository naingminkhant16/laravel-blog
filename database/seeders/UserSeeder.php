<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => "Naing Min Khant",
            'email' => 'nmk@gmail.com',
            'role' => 'admin'
        ]);
        User::factory()->create([
            'name' => "Editor",
            'email' => 'editor@gmail.com',
            'role' => 'editor'
        ]);
        User::factory(20)->create();
    }
}
