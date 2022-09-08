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

it('includes paddle checkout button', function () {
    // Arrange
    config()->set('services.paddle.vendor-id', 'vendor-id');
    $course = Course::factory()->create(['paddle_product_id' => 'product-id']);

    // Act & Assert
    get(route('page.course-details', $course))
        ->assertOk()
        ->assertSee('Paddle.Setup({vendor: vendor-id});')
        ->assertSee('<script src="https://cdn.paddle.com/paddle/paddle.js"></script>', false)
        ->assertSee('<a href="#!" data-product="product-id" data-theme="none" class="paddle_button', false);
});

it('includes a title', function() {
    // Arrange
    $course = Course::factory()->create();
    $expectedTitle = config('app.name') . " - $course->title";

    // Act & Assert
    get(route('page.course-details', $course))
        ->assertOk()
        ->assertSee("<title>$expectedTitle</title>", false);
});

it('includes social tags', function () {
    // Arrange
    $course = Course::factory()->create();

    // Act & Assert
    get(route('page.course-details', $course))
        ->assertOk()
        ->assertSee([
            '<meta name="description" content="' . $course->description . '">',
            '<meta property="og:type" content="website">',
            '<meta property="og:url" content="' . route('page.course-details', $course) . '">',
            '<meta property="og:title" content="' . $course->title . '">',
            '<meta property="og:description" content="' . $course->description . '">',
            '<meta property="og:image" content="' . asset("images/$course->image_name") . '">',
            '<meta name="twitter:card" content="summary_large_image">',
        ], false);
});
