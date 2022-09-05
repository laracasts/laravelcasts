<?php

use App\Http\Livewire\VideoPlayer;
use App\Models\Course;
use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\Sequence;
use function Pest\Laravel\get;

it('cannot be accessed by guest', function () {
    // Arrange
    $course = Course::factory()
        ->has(Video::factory())
        ->create();

    // Act & Assert
    get(route('page.videos', $course))
        ->assertRedirect(route('login'));
});

it('includes video player', function () {
    // Arrange
    $course = Course::factory()
        ->has(Video::factory())
        ->create();

    // Act & Assert
    loginAsUser();
    get(route('page.videos', $course))
        ->assertOk()
        ->assertSeeLivewire(VideoPlayer::class);
});

it('shows first course video by default', function () {
    // Arrange
    $course = Course::factory()
        ->has(Video::factory()->count(2))
        ->create();

    // Act & Assert
    loginAsUser();
    get(route('page.videos', $course))
        ->assertOk()
        ->assertSee("<h3>{$course->videos->first()->title}", false);
});

it('shows provided course video', function () {
    // Arrange
    $course = Course::factory()
        ->has(Video::factory()
            ->state(new Sequence(['title' => 'First video'], ['title' => 'Second video']))
            ->count(2))
        ->create();

    // Act & Assert
    loginAsUser();
    get(route('page.videos', ['course' => $course, 'video' => $course->videos()->orderByDesc('id')->first()]))
        ->assertOk()
        ->assertSeeText('Second video');
});
