<?php


use App\Jobs\HandlePaddlePurchaseJob;
use App\Mail\NewPurchaseMail;
use App\Models\Course;
use App\Models\PurchasedCourse;
use App\Models\User;

it('stores paddle purchase', function () {
    // Act
    Mail::fake();
    $this->assertDatabaseCount(User::class, 0);
    $this->assertDatabaseCount(PurchasedCourse::class, 0);

    // Arrange
    $course = Course::factory()->create(['paddle_product_id' => '34779']);
    $webhookCall = Spatie\WebhookClient\Models\WebhookCall::create([
        'name' => 'default',
        'url' => 'some-url',
        'payload' => [
            'email' => 'test@test.at',
            'name' => 'Test User',
            'p_product_id' => '34779',
        ],
    ]);

    // Act
    (new HandlePaddlePurchaseJob($webhookCall))->handle();

    // Assert
    $this->assertDatabaseHas(User::class, [
        'email' => $webhookCall->payload['email'],
        'name' => $webhookCall->payload['name'],
    ]);

    $user = User::where('email', $webhookCall->payload['email'])->first();
    $this->assertDatabaseHas(PurchasedCourse::class, [
        'user_id' => $user->id,
        'course_id' => $course->id
    ]);
});

it('stores paddle purchase with given user', function () {
    // Arrange
    Mail::fake();
    $course = Course::factory()->create(['paddle_product_id' => '34779']);
    $user = User::factory()->create(['email' => 'test@test.at']);
    $webhookCall = Spatie\WebhookClient\Models\WebhookCall::create([
        'name' => 'default',
        'url' => 'some-url',
        'payload' => [
            'email' => 'test@test.at',
            'name' => 'Test User',
            'p_product_id' => '34779',
        ],
    ]);

    // Act
    (new HandlePaddlePurchaseJob($webhookCall))->handle();

    // Assert
    $this->assertDatabaseCount(User::class, 1);
    $this->assertDatabaseHas(PurchasedCourse::class, [
        'user_id' => $user->id,
        'course_id' => $course->id
    ]);
});

it('sends out purchase email', function () {
    // Arrange
    Mail::fake();
    Course::factory()->create(['paddle_product_id' => '34779']);
    $webhookCall = Spatie\WebhookClient\Models\WebhookCall::create([
        'name' => 'default',
        'url' => 'some-url',
        'payload' => [
            'email' => 'test@test.at',
            'name' => 'Test User',
            'p_product_id' => '34779',
        ],
    ]);

    // Act
    (new HandlePaddlePurchaseJob($webhookCall))->handle();

    // Assert
    Mail::assertSent(NewPurchaseMail::class);
});
