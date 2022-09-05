<?php

use App\Models\Course;

it('adds given courses', function () {
    // Assert
    $this->assertDatabaseCount(Course::class, 0);

    // Act
    $this->artisan('db:seed');

    // Assert
    $this->assertDatabaseCount(Course::class, 3);
    $this->assertDatabaseHas(Course::class, ['title' => 'Laravel For Beginners']);
    $this->assertDatabaseHas(Course::class, ['title' => 'Advanced Laravel']);
});

it('adds given courses only once', function () {
    // Act
    $this->artisan('db:seed');
    $this->artisan('db:seed');

    // Assert
    $this->assertDatabaseCount(Course::class, 3);
});

it('adds given videos', function () {
    // Act
    $this->artisan('db:seed');
    $laravelForBeginnersCourse = Course::where('title', 'Laravel For Beginners')->first();
    $advancedLaravelCourse = Course::where('title', 'Advanced Laravel')->first();
    $tddTheLaravelWayCourse = Course::where('title', 'TDD The Laravel Way')->firstOrFail();

    // Assert
    expect($laravelForBeginnersCourse)
        ->videos
        ->toHaveCount(3);

    expect($advancedLaravelCourse)
        ->videos
        ->toHaveCount(3);

    expect($tddTheLaravelWayCourse)
        ->videos
        ->toHaveCount(2);
});

it('adds given videos only once', function () {
    // Act
    $this->artisan('db:seed');
    $this->artisan('db:seed');
    $laravelForBeginnersCourse = Course::where('title', 'Laravel For Beginners')->first();
    $advancedLaravelCourse = Course::where('title', 'Advanced Laravel')->first();

    // Assert
    expect($laravelForBeginnersCourse)
        ->videos
        ->toHaveCount(3);

    expect($advancedLaravelCourse)
        ->videos
        ->toHaveCount(3);
});
