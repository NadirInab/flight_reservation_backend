<?php

namespace Database\Factories;

use App\Models\Flight;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Flight>
 */
class FlightFactory extends Factory
{
    protected $model = Flight::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'flight_name' => $this->faker->name,
            'date' => $this->faker->dateTimeBetween('now', '+1 year')->format('Y-m-d'),
            'from' => $this->faker->text(5),
            'to' => $this->faker->text(5),
            'airport' => $this->faker->text(10),
            'airline' => $this->faker->text(15),
            'aircraft' => $this->faker->regexify('[A-Z]{3}-\d{3}'),
            'price' => $this->faker->randomFloat(2, 100, 1000),
            'number_of_seats' => $this->faker->numberBetween(50, 300),
        ];
    }
}
