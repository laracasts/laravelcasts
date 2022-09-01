<?php

use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\get;

uses(RefreshDatabase::class);

it('gives successful response for home page', function () {
    // Act & Assert
    get(route('page.home'))->assertOk();
});

it('gives successful response for course details page', function () {
    // Arrange
    $course = Course::factory()->create();

    // Act & Assert
    get(route('page.course-details', $course))->assertOk();
});
