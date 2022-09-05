<?php

use App\Http\Livewire\VideoPlayer;
use App\Models\Course;
use App\Models\User;
use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\Sequence;

function createCourseAndVideos(int $videosCount = 1, array|Sequence $videosState = [])
{
    return Course::factory()
        ->has(Video::factory()
            ->count($videosCount)
            ->state($videosState)
        )
        ->create();
}

it('shows details from given video', function () {
    // Arrange
    $course = createCourseAndVideos();
    $video = $course->videos()->first();

    // Act & Assert
    Livewire::test(VideoPlayer::class, ['video' => $video])
        ->assertSeeText([
            $video->title,
            $video->description,
            "({$video->duration_in_min}min)",
        ]);
});

it('shows given video', function () {
    // Arrange
    $course = createCourseAndVideos();
    $video = $course->videos()->first();

    // Act & Assert
    Livewire::test(VideoPlayer::class, ['video' => $video])
        ->assertSeeHtml('<iframe src="https://player.vimeo.com/video/'.$video->vimeo_id);
});

it('shows list of all course videos', function () {
    // Arrange
    $course = createCourseAndVideos(videosCount: 3);

    // Act & Assert
    Livewire::test(VideoPlayer::class, ['video' => $course->videos()->first()])
        ->assertSee([
            ...$course->videos->pluck('title')->toArray(),
        ])->assertSeeHtml([
            route('page.videos', [$course, $course->videos[1]]),
            route('page.videos', [$course, $course->videos[2]]),
        ]);
});

it('does not include route for current video', function () {
    // Arrange
    $course = createCourseAndVideos();

    // Act & Assert
    Livewire::test(VideoPlayer::class, ['video' => $course->videos()->first()])
        ->assertDontSeeHtml([
            route('page.videos', $course->videos()->first()),
            route('page.videos', [$course, Video::where('title', 'First video')->first()]),
            route('page.videos', [$course, Video::where('title', 'Second video')->first()]),
            route('page.videos', [$course, Video::where('title', 'Third video')->first()]),
        ]);
});

it('marks video as completed', function () {
    // Arrange
    $course = createCourseAndVideos();
    $user = User::factory()->create();
    $user->purchasedCourses()->attach($course);

    // Assert
    expect($user->watchedVideos)->toHaveCount(0);

    // Act & Assert
    loginAsUser($user);
    Livewire::test(VideoPlayer::class, ['video' => $course->videos()->first()])
        ->call('markVideoAsCompleted');

    // Assert
    $user->refresh();
    expect($user->watchedVideos)
        ->toHaveCount(1)
        ->first()->title->toEqual($course->videos()->first()->title);
});

it('marks video as not completed', function () {
    // Arrange
    $user = User::factory()->create();
    $course = createCourseAndVideos();
    $user->purchasedCourses()->attach($course);
    $user->watchedVideos()->attach($course->videos()->first());

    // Assert
    expect($user->watchedVideos)->toHaveCount(1);

    // Act & Assert
    loginAsUser($user);
    Livewire::test(VideoPlayer::class, ['video' => $course->videos()->first()])
        ->call('markVideoAsNotCompleted');

    // Assert
    $user->refresh();
    expect($user->watchedVideos)
        ->toHaveCount(0);
});
