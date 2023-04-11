<?php

namespace Database\Factories;

use App\Models\Flight;
use App\Models\User ;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'flight_id' => Flight::factory(),
            'passenger_id' => User::factory(),
        ];
    }
}
