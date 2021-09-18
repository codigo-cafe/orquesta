<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class PhoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        DB::table('phones')->insert(array(
            array(
                'number' => $faker->phoneNumber,
                'person_id' => 1,
            ),
            array(
                'number' => $faker->phoneNumber,
                'person_id' => 2,
            ),
            array(
                'number' => $faker->phoneNumber,
                'person_id' => 3,
            ),
            array(
                'number' => $faker->phoneNumber,
                'person_id' => 4,
            ),
            array(
                'number' => $faker->phoneNumber,
                'person_id' => 5,
            ),
            array(
                'number' => $faker->phoneNumber,
                'person_id' => 6,
            ),
            array(
                'number' => $faker->phoneNumber,
                'person_id' => 7,
            ),
        ));
    }
}
