<?php

namespace Database\Factories;

use App\Constants\Constants;
use App\Models\penalty;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<penalty>
 */
class PenaltyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $days = fake()->numberBetween(1, 100);
        
        return [
            'days' => $days,
            'amount' => $days * Constants::BASE_PRICE_PER_DAY_FOR_PENALTY,
        ];
    }
}
