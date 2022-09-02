<?php

use App\Models\Course;
use App\Models\Video;
use function Pest\Laravel\get;

it('shows course details', function () {
    // Arrange
    $course = Course::factory()
        ->has(Video::factory())
        ->released()
        ->create();

    // Act & Assert
    get(route('page.course-details', $course))
        ->assertOk()
        ->assertSeeText([
            $course->title,
            $course->tagline,
            $course->description,
            ...$course->learnings,
        ])
        ->assertSee($course->image_name);
});

it('shows course video count', function () {
    // Arrange
    $course = Course::factory()
        ->has(Video::factory()->count(3))
        ->released()
        ->create();

    // Act & Assert
    get(route('page.course-details', $course))
        ->assertOk()
        ->assertSeeText('3 videos');
});
