<?php

namespace Database\Factories;

use App\Models\Reservation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = fake()->dateTimeInInterval('now', '10 days');
        $daysToAdd = fake()->numberBetween(7, 14);
        
        return [
            'start_date' => $startDate,
            'end_date' => (clone $startDate)->modify("+{$daysToAdd} days"),
        ];
    }
}
