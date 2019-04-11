<?php

use Illuminate\Database\Seeder;
use App\Sale;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	 $carbon = Carbon::createFromFormat('Y-m-d H:i:s' ,Carbon::now(),'America/Chicago');
        $faker = Faker\Factory::create();

    	for($i = 0; $i < 10000; $i++) {
        	App\Sale::create([
            	'price' => $faker->randomNumber(3),
            	'created_at' => $carbon->addDays(1),
        	]);
    	}
    }
}
