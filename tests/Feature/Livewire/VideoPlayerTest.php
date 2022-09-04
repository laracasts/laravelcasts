<?php

use App\Http\Livewire\VideoPlayer;
use App\Models\Course;
use App\Models\Video;

it('shows details from given video', function () {
    // Arrange
    $course = Course::factory()
        ->has(Video::factory()->state([
            'title' => 'Video title',
            'description' => 'Video description',
            'duration' => 10,
        ]))
        ->create();

    // Act & Assert
    Livewire::test(VideoPlayer::class, ['video' => $course->videos()->first()])
        ->assertSeeText([
            'Video title',
            'Video description',
            '10min',
        ]);
});

it('shows given video', function () {
    // Arrange
    $course = Course::factory()
        ->has(Video::factory()->state([
            'vimeo_id' => 'vimeo-id',
        ]))
        ->create();

    // Act & Assert
    Livewire::test(VideoPlayer::class, ['video' => $course->videos()->first()])
        ->assertSee('<iframe src="https://player.vimeo.com/video/vimeo-id"', false);
});
