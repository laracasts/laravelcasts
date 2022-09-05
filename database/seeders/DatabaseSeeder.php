<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(AddGivenCoursesSeeder::class);
        $this->call(AddGivenVideosSeeder::class);
        $this->call(TestUserSeeder::class);
    }
}
