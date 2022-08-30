<?php

namespace Database\Factories;

use App\Models\Course;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    protected $model = Course::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
        ];
    }

    public function released(Carbon $releasedAt = null): self
    {
        return $this->state(
            fn(array $attributes) => ['released_at' => $releasedAt ?? now()]
        );
    }
}
