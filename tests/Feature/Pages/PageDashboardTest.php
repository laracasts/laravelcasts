<?php

use App\Models\Course;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\get;

uses(RefreshDatabase::class);

it('cannot be accessed by guest', function () {
    // Act & Assert
    get(route('dashboard'))
        ->assertRedirect(route('login'));
});

it('lists purchased courses', function () {
    // Arrange
    $user = User::factory()
        ->has(Course::factory()
            ->count(2)
            ->state(new Sequence(
                ['title' => 'Product A'],
                ['title' => 'Product B'],
            )))
        ->create();

    // Act
    $this->actingAs($user);
    get(route('dashboard'))
        ->assertOk()
        ->assertSeeText([
            'Product A',
            'Product B',
        ]);
});

it('does not list other courses', function () {
    // Arrange
    $user = User::factory()->create();
    $course = Course::factory()->create();

    // Act & Assert
    $this->actingAs($user);
    get(route('dashboard'))
        ->assertOk()
        ->assertDontSeeText($course->title);
});

it('shows latest purchased course first', function () {
    // Arrange
    $user = User::factory()->create();
    $firstPurchasedCourse = Course::factory()->create();
    $latestPurchasedCourse = Course::factory()->create();

    $user->courses()->attach($firstPurchasedCourse, ['created_at' => Carbon::yesterday()]);
    $user->courses()->attach($latestPurchasedCourse, ['created_at' => Carbon::now()]);

    // Act
    $this->actingAs($user);
    get(route('dashboard'))
        ->assertOk()
        ->assertSeeInOrder([
            $latestPurchasedCourse->title,
            $firstPurchasedCourse->title,
        ]);
});

it('includes link to product videos', function () {
    // Arrange
    $user = User::factory()
        ->has(Course::factory())
        ->create();

    // Act
    $this->actingAs($user);
    get(route('dashboard'))
        ->assertOk()
        ->assertSeeText('Watch videos')
        ->assertSee(route('page.course-videos', Course::first()));
});