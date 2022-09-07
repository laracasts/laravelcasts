<?php

use App\Console\Commands\TweetAboutCourseReleaseCommand;
use App\Models\Course;

it('tweets about release for provided course', function () {
    // Arrange
    Twitter::fake();
    $course = Course::factory()->create(['title' => 'Laravel For Beginners']);

    // Act
    $this->artisan(TweetAboutCourseReleaseCommand::class, ['courseId' => $course->id]);

    // Assert
    Twitter::assertTweetSent('I just released Laravel For Beginners 🎉 Check it out on '.route('page.course-details', $course));
});
