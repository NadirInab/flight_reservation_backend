<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $addFlight = "add Flight";
        $upDateFlight = "upDate Flight";
        $deleteFlight = "delete Flight";
        $bookTicket = "Book Ticket" ;
        

        Permission::create(['name' => $addFlight]);
        Permission::create(['name' => $upDateFlight]);
        Permission::create(['name' => $deleteFlight]);
        Permission::create(['name' => $bookTicket]);

        $admin = "admin";
        $passenger = "passenger";

        Role::create(['name' => $admin])->givePermissionTo(Permission::all());
        Role::create(['name' => $passenger])->givePermissionTo([
            $bookTicket
        ]);

    }
}
