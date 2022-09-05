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
            'description' => 'A video course to teach you Laravel from scratch. We will start right at the beginning, and will grow your Laravel knowledge step by step together.',
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
            'description' => 'A video course to teach you advanced techniques in Laravel. You already find yourself around in Laravel, but are ready for the next step? Look no further. Let us do this.',
            'image_name' => 'advanced_laravel.png',
            'learnings' => [
                'How to use the service container',
                'Pipelines in Laravel',
                'Secure your application',
            ],
            'released_at' => now(),
        ]);

        Course::create([
            'slug' => Str::of('TDD The Laravel Way')->slug(),
            'title' => 'TDD The Laravel Way',
            'tagline' => 'Give testing the importance it deserves',
            'description' => 'A video course to teach you test-driven development in a Laravel application. TDD is not something you can just do. It takes time and practice. In this course, I will show you how to get started.',
            'image_name' => 'tdd_the_laravel_way.png',
            'learnings' => [
                'What TDD is',
                'How to use TDD in Laravel',
                'Work on a TDD mindset',
            ],
            'released_at' => now(),
        ]);
    }

    private function isDataAlreadyGiven(): bool
    {
        return Course::where('title', 'Laravel For Beginners')->exists()
            && Course::where('title', 'Advanced Laravel')->exists()
            && Course::where('title', 'TDD The Laravel Way')->exists();
    }
}
