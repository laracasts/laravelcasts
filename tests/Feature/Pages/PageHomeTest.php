<?php

use App\Models\Course;
use Illuminate\Support\Carbon;
use Juampi92\TestSEO\TestSEO;
use function Pest\Laravel\get;

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

it('includes login if not logged in', function () {
    // Act & Assert
    get(route('page.home'))
        ->assertOk()
        ->assertSeeText('Login')
        ->assertSee(route('login'));
});

it('includes link to dashboard if logged in', function () {
    // Act & Assert
    loginAsUser();
    get(route('page.home'))
        ->assertOk()
        ->assertSeeText('Dashboard')
        ->assertSee(route('page.dashboard'));
});

it('includes courses link', function () {
    // Arrange
    $firstCourse = Course::factory()->released()->create();
    $secondCourse = Course::factory()->released()->create();
    $lastCourse = Course::factory()->released()->create();

    // Act & Assert
    get(route('page.home'))
        ->assertOk()
        ->assertSee([
            route('page.course-details', $firstCourse),
            route('page.course-details', $secondCourse),
            route('page.course-details', $lastCourse),
        ]);
});

it('includes title', function() {
    // Arrange
    $expectedTitle = config('app.name') . ' - Home';

    // Act
    $response = get(route('page.home'))
        ->assertOk();

    // Assert
    $seo = new TestSEO($response->getContent());
    expect($seo->data)
        ->title()->toBe($expectedTitle);
});

it('includes social tags', function () {
    // Act
    $response = get(route('page.home'))
        ->assertOk();

    // Assert
    $seo = new TestSEO($response->getContent());
    expect($seo->data)
        ->description()->toBe('LaravelCasts is the leading learning platform for Laravel developers.')
        ->openGraph()->type->toBe('website')
        ->openGraph()->url->toBe(route('page.home'))
        ->openGraph()->title->toBe('LaravelCasts')
        ->openGraph()->description->toBe('LaravelCasts is the leading learning platform for Laravel developers.')
        ->openGraph()->image->toBe(asset('images/social.png'))
        ->twitter()->card->toBe('summary_large_image');
});
