<?php

namespace Database\Seeders;

// use App\Models\Flight;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FlightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Flight::factory()
        ->count(20)
        ->create();
    }
}
