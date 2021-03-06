<?php

namespace Database\Factories;

use App\Models\Car;
use App\Models\Season;
use App\Models\TrackVariation;
use DateTime;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Round>
 */
class RoundFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $startsAt = new DateTime;
        $endsAt = $startsAt->modify('+1 week');
        $text = $this->faker->text(5);
        return [
            'season_id' => Season::factory(),
            'track_variation_id' => TrackVariation::factory(),
            'car_id' => Car::factory(),
            'name' => $this->faker->name(),
            'tla' => substr($text, 0, 3),
            'starts_at' => $startsAt->format('Y-m-d'),
            'ends_at' => $endsAt->format('Y-m-d'),
        ];
    }

    public function active(): static
    {
        return $this->state(function (array $attributes) {
            $starts = (new DateTime())->modify('-1 day')->format('Y-m-d');
            $endsAt = (new DateTime())->modify('+6 days');
            return [
                'starts_at' => $starts,
                'ends_at' => $endsAt->format('Y-m-d'),
            ];
        });
    }
}
