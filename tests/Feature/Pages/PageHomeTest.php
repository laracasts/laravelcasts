<?php

use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use function Pest\Laravel\get;

uses(RefreshDatabase::class);

it('shows courses overview', function () {
    // Arrange
    $firstCourse = Course::factory()->released()->create();
    $secondCourse = Course::factory()->released()->create();
    $lastCourse = Course::factory()->released()->create();

    // Act & Assert
    get(route('page.home'))
        ->assertOk()
        ->assertSeeText([
            $firstCourse->title,
            $firstCourse->description,
            $secondCourse->title,
            $secondCourse->description,
            $lastCourse->title,
            $lastCourse->description,
        ]);
});

it('only shows released courses', function () {
    // Arrange
    $releasedCourse = Course::factory()
        ->released()
        ->create();

    $notReleasedCourse = Course::factory()
        ->create();

    // Act & Assert
    get(route('page.home'))
        ->assertOk()
        ->assertSeeText($releasedCourse->title)
        ->assertDontSeeText($notReleasedCourse->title);
});

it('shows courses ordered by released date', function () {
    // Arrange
    $releasedCourse = Course::factory()->released(Carbon::yesterday())->create();
    $newestReleasedCourse = Course::factory()->released()->create();

    // Act & Assert
    get(route('page.home'))
        ->assertOk()
        ->assertSeeInOrder([
            $newestReleasedCourse->title,
            $releasedCourse->title,
        ]);
});

it('includes courses link', function () {
    // Arrange
    $firstCourse = Course::factory()->released()->create();
    $secondCourse = Course::factory()->released()->create();
    $lastCourse = Course::factory()->released()->create();

    // Act & Assert
    get(route('page.home'))
        ->assertOk()
        ->assertsee([
            route('page.course-details', $firstCourse),
            route('page.course-details', $secondCourse),
            route('page.course-details', $lastCourse),
        ]);
});