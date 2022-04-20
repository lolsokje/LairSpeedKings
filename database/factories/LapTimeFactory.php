<?php

namespace Database\Factories;

use App\Enums\LapTimeStatus;
use App\Models\Round;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LapTime>
 */
class LapTimeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'round_id' => Round::factory(),
            'lap_time' => $this->faker->numberBetween(60000, 180000),
            'video_url' => $this->faker->url(),
            'status' => LapTimeStatus::SUBMITTED,
        ];
    }
}
