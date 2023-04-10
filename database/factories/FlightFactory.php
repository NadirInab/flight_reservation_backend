<?php

namespace Database\Factories;

use App\Models\City;
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
        $cities = City::pluck('cityName')->toArray();
        $from = $this->faker->randomElement($cities);
        $to = $this->faker->randomElement(array_diff($cities, [$from]));

        return [
            'flight_name' => $this->faker->name,
            "from" => $from,
            "to" => $to,
            'date' => $this->faker->dateTimeBetween('now', '+1 year')->format('Y-m-d H:i:s'),
            'airline' => $this->faker->text(15),
            'aircraft' => $this->faker->regexify('[A-Z]{3}-\d{3}'),
            'price' => $this->faker->randomFloat(2, 100, 1000),
            'number_of_seats' => $this->faker->numberBetween(50, 300),
        ];
    }
}
