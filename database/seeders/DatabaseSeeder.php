<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Raseduz Zaman Rasel',
        //     'email' => 'rasel06@gmail.com',
        //     'password' => bcrypt('123456'), // password
        // ]);

        $this->call([
            // UserSeeder::class,
            // RoleSeeder::class,
            // PermissionSeeder::class,
            PostSeeder::class,
            CommentSeeder::class,
        ]);
    }
}
