<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            PlacesTableSeeder::class,
            PerformersTableSeeder::class,
            EventsTableSeeder::class,
            TicketsTableSeeder::class,
        ]);
    }
}
