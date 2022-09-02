<?php

use App\Models\Course;
use App\Models\Video;

it('only returns released courses for released query scope', function () {
    // Arrange
    Course::factory()->released()->create();
    Course::factory()->create();

    // Act && Assert
    expect(Course::released()->get())
        ->toHaveCount(1)
        ->first()->id->toEqual(1);
});

it('has videos', function () {
    // Arrange
    $course = Course::factory()->released()->create();
    Video::factory()->count(3)->create(['course_id' => $course->id]);

    // Act & Assert
    expect($course->videos)
        ->toHaveCount(3)
        ->each->toBeInstanceOf(Video::class);
});
