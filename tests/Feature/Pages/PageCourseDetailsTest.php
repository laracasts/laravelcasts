<?php

use App\Models\Course;
use App\Models\Video;
use Juampi92\TestSEO\TestSEO;
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

it('includes title', function() {
    // Arrange
    $course = Course::factory()->create();
    $expectedTitle = config('app.name') . ' - ' . $course->title;

    // Act
    $response = get(route('page.course-details', $course))
        ->assertOk();

    // Assert
    $seo = new TestSEO($response->getContent());
    expect($seo->data)
        ->title()->toBe($expectedTitle);
});

it('includes social tags', function () {
    // Arrange
    $course = Course::factory()->create();

    // Act
    $response = get(route('page.course-details', $course))
        ->assertOk();

    // Assert
    $seo = new TestSEO($response->getContent());
    expect($seo->data)
        ->description()->toBe($course->description)
        ->openGraph()->type->toBe('website')
        ->openGraph()->url->toBe(route('page.course-details', $course))
        ->openGraph()->title->toBe($course->title)
        ->openGraph()->description->toBe($course->description)
        ->openGraph()->image->toBe(asset("images/$course->image_name"))
        ->twitter()->card->toBe('summary_large_image');

});
