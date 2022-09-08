<?php

use App\Models\Course;
use Illuminate\Support\Carbon;
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
    $expectedTitle = config('app.name', 'Laravel') . ' - Home';

    // Act & Assert
    get(route('page.home'))
        ->assertOk()
        ->assertSee("<title>$expectedTitle</title>", false);
});

it('includes social tags', function () {
    // Act & Assert
    get(route('page.home'))
        ->assertOk()
        ->assertSee([
            '<meta name="description" content="LaravelCasts is the leading learning platform for Laravel developers.">',
            '<meta property="og:type" content="website">',
            '<meta property="og:url" content="' . route('page.home') . '">',
            '<meta property="og:title" content="LaravelCasts">',
            '<meta property="og:description" content="LaravelCasts is the leading learning platform for Laravel developers.">',
            '<meta property="og:image" content="' . asset('images/social.png') . '">',
            '<meta name="twitter:card" content="summary_large_image">',
        ], false);
});
