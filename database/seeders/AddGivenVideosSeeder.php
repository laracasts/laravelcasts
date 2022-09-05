<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Video;
use Illuminate\Database\Seeder;

class AddGivenVideosSeeder extends Seeder
{
    public function run(): void
    {
        if ($this->isDataAlreadyGiven()) {
            return;
        }

        $laravelForBeginnersCourse = Course::where('title', 'Laravel For Beginners')->firstOrFail();
        $advancedLaravelCourse = Course::where('title', 'Advanced Laravel')->firstOrFail();
        $tddTheLaravelWayCourse = Course::where('title', 'TDD The Laravel Way')->firstOrFail();

        Video::insert([
            [
                'course_id' => $laravelForBeginnersCourse->id,
                'slug' => 'intro',
                'vimeo_id' => '330287829',
                'title' => 'Intro',
                'description' => 'Welcome to this new course. Let me tell you what you are going to learn in the next videos.',
                'duration_in_min' => 1,
            ],
            [
                'course_id' => $laravelForBeginnersCourse->id,
                'slug' => 'routes-are-your-friends',
                'vimeo_id' => '329875646',
                'title' => 'Routes are your friends',
                'description' => 'Routes are fundamental to every web application. Laravel provides a simple syntax to define them.',
                'duration_in_min' => 4,
            ],
            [
                'course_id' => $laravelForBeginnersCourse->id,
                'slug' => 'views-101',
                'vimeo_id' => '331956991',
                'title' => 'Views 101',
                'description' => 'We cannot talk about routes without talking about views. Together they will make sure we can show our users a beautiful response.',
                'duration_in_min' => 7,
            ],
            [
                'course_id' => $advancedLaravelCourse->id,
                'slug' => 'welcome',
                'vimeo_id' => '333506858',
                'title' => 'Welcome',
                'description' => 'Welcome to Advanced Laravel. Are you ready to level up your Laravel skills?',
                'duration_in_min' => 2,
            ],
            [
                'course_id' => $advancedLaravelCourse->id,
                'slug' => 'the-service-container',
                'vimeo_id' => '333173142',
                'title' => 'The Service Container',
                'description' => 'The service container is one of the most powerful concepts of Laravel, but at the same time, one of the most difficult concepts to grasp. Let me help you.',
                'duration_in_min' => 12,
            ],
            [
                'course_id' => $advancedLaravelCourse->id,
                'slug' => 'the-pipeline-pattern',
                'vimeo_id' => '737854276',
                'title' => 'The Pipeline Pattern',
                'description' => 'Have you ever heard of the Pipeline Pattern? No? Let us fix this today.',
                'duration_in_min' => 8,
            ],
            [
                'course_id' => $tddTheLaravelWayCourse->id,
                'slug' => 'tdd-basics',
                'vimeo_id' => '356868182',
                'title' => 'TDD Basics',
                'description' => 'Let us start with the basics of TDD. Only with time and experience you can master test-driven development.',
                'duration_in_min' => 23,
            ],
            [
                'course_id' => $tddTheLaravelWayCourse->id,
                'slug' => 'laravel-tricks-for-tdd',
                'vimeo_id' => '354598551',
                'title' => 'Laravel tricks for TDD',
                'description' => 'Laravel is an amazing framework for PHP. But also for testing, it has a lot of cool features that will help us on our journey to TDD.',
                'duration_in_min' => 14,
            ],
        ]);
    }

    private function isDataAlreadyGiven(): bool
    {
        $laravelForBeginnersCourse = Course::where('title', 'Laravel For Beginners')->firstOrFail();
        $advancedLaravelCourse = Course::where('title', 'Advanced Laravel')->firstOrFail();
        $tddTheLaravelWayCourse = Course::where('title', 'TDD The Laravel Way')->firstOrFail();

        return $laravelForBeginnersCourse->videos()->count() === 3
            && $advancedLaravelCourse->videos()->count() === 3
            && $tddTheLaravelWayCourse->videos()->count() === 2;
    }
}
