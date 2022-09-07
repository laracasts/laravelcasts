<?php

use App\Mail\NewPurchaseMail;
use App\Models\Course;

it('includes purchased course details', function () {
    // Arrange
    $course = Course::factory()->make();

    // Act
    $mail = new NewPurchaseMail($course);

    // Assert
    $mail->assertSeeInHtml("Thanks for purchasing $course->title");
    $mail->assertSeeInHtml('Login');
    $mail->assertSeeInHtml(route('login'));
});
