<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Payement;
use Faker\Provider\ar_EG\Payment;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // \App\Models\City::factory(10)->create();
        // \App\Models\Flight::factory(10)->create();
        // \App\Models\Ticket::factory(10)->create();
        $this->call([
            RolesAndPermissionsSeeder::class,
            UserSeeder::class, 
            CitySeeder::class,
            FlightSeeder::class, 
            TicketSeeder::class, 
            PaymentSeeder::class
        ]) ;
    }
}
