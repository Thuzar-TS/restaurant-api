<?php

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
        // Restaurant
        $this->call(RestaurantSeeder::class);

        // Type
        $this->call(TypeSeeder::class);
    }
}
