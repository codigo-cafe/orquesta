<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use DB;

class PersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        DB::table('people')->insert(array(
            array(
                'name' => $faker->firstName,
                'surnames' => $faker->lastName,
                'profile_photo_path' => null,
                'type_id' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            array(
                'name' => $faker->firstName,
                'surnames' => $faker->lastName,
                'profile_photo_path' => null,
                'type_id' => 4,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            array(
                'name' => $faker->firstName,
                'surnames' => $faker->lastName,
                'profile_photo_path' => null,
                'type_id' => 5,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            array(
                'name' => $faker->firstName,
                'surnames' => $faker->lastName,
                'profile_photo_path' => null,
                'type_id' => 6,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            array(
                'name' => $faker->firstName,
                'surnames' => $faker->lastName,
                'profile_photo_path' => null,
                'type_id' => 7,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
        ));
    }
}
