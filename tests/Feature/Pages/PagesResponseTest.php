<?php

use App\Models\Course;
use function Pest\Laravel\get;

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

it('gives successful response for dashboard page', function () {
    // Act & Assert
    loginAsUser();
    get(route('page.dashboard'))->assertOk();
});

it('does not find the Jetstream registration page', function () {
    // Act & Assert
    get('register')->assertNotFound();
});
