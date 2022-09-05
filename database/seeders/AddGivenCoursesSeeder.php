<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AddGivenCoursesSeeder extends Seeder
{
    public function run(): void
    {
        if ($this->isDataAlreadyGiven()) {
            return;
        }

        Course::create([
            'slug' => Str::of('Laravel For Beginners')->slug(),
            'title' => 'Laravel For Beginners',
            'tagline' => 'Make your first steps as a Laravel dev.',
            'description' => 'A video course to teach you Laravel.',
            'image_name' => 'laravel_for_beginners.png',
            'learnings' => [
                'How to start with Laravel',
                'Where to start with Laravel',
                'Build your first Laravel application',
            ],
            'released_at' => now(),
        ]);

        Course::create([
            'slug' => Str::of('Advanced Laravel')->slug(),
            'title' => 'Advanced Laravel',
            'tagline' => 'Level up as a Laravel developer.',
            'description' => 'A video course to teach you advanced techniques in Laravel.',
            'image_name' => 'advanced_laravel.png',
            'learnings' => [
                'How to use the service container',
                'Pipelines in Laravel',
                'Secure your application',
            ],
            'released_at' => now(),
        ]);
    }

    private function isDataAlreadyGiven(): bool
    {
        return Course::where('title', 'Laravel For Beginners')->exists()
            && Course::where('title', 'Advanced Laravel')->exists();
    }
}
