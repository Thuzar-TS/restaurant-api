<?php

use App\Type;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $typeData = [
            [
                'description' => "Fine Dining",
            ],
            [
                'description' => "Casual Dining",
            ],
            [
                'description' => "Family Style",
            ],
            [
                'description' => "Fast Casual",
            ],
            [
                'description' => "Fast Food",
            ],
            [
                'description' => "Cafe",
            ],
            [
                'description' => "Buffet",
            ],
            [
                'description' => "Delivery Only Restaurant",
            ],
		];
        DB::table('types')->insert($typeData);
    }
}
