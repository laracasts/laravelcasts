<?php

use App\Models\Course;
use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\get;

uses(RefreshDatabase::class);

it('shows course details', function () {
    // Arrange
    $course = Course::factory()->released()->create([
        'image' => 'my-course.png',
        'learnings' => [
            'Learn Laravel routes',
            'Learn Laravel views',
            'Learn Laravel commands',
        ],
    ]);
    Video::factory()->create(['course_id' => $course->id]);

    // Act & Assert
    get(route('course-details', $course->slug))
        ->assertSeeText([
            $course->title,
            $course->tagline,
            $course->description,
            'Learn Laravel routes',
            'Learn Laravel views',
            'Learn Laravel commands',
        ])
        ->assertSee($course->image);
});

it('shows course video count', function () {
    // Arrange
    $course = Course::factory()->released()->create();
    Video::factory()->count(3)->create(['course_id' => $course->id]);

    // Act & Assert
    get(route('course-details', $course->slug))
        ->assertSeeText('3 videos');
});
