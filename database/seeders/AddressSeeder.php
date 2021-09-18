<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        DB::table('addresses')->insert(array(
            array(
                'neighborhood' => $faker->streetName,
                'streets' => $faker->secondaryAddress,
                'number' => $faker->buildingNumber,
                'person_id' => 1,
            ),
            array(
                'neighborhood' => $faker->streetName,
                'streets' => $faker->secondaryAddress,
                'number' => $faker->buildingNumber,
                'person_id' => 2,
            ),
            array(
                'neighborhood' => $faker->streetName,
                'streets' => $faker->secondaryAddress,
                'number' => $faker->buildingNumber,
                'person_id' => 3,
            ),
            array(
                'neighborhood' => $faker->streetName,
                'streets' => $faker->secondaryAddress,
                'number' => $faker->buildingNumber,
                'person_id' => 4,
            ),
            array(
                'neighborhood' => $faker->streetName,
                'streets' => $faker->secondaryAddress,
                'number' => $faker->buildingNumber,
                'person_id' => 5,
            ),
            array(
                'neighborhood' => $faker->streetName,
                'streets' => $faker->secondaryAddress,
                'number' => $faker->buildingNumber,
                'person_id' => 6,
            ),
            array(
                'neighborhood' => $faker->streetName,
                'streets' => $faker->secondaryAddress,
                'number' => $faker->buildingNumber,
                'person_id' => 7,
            ),
        ));
    }
}
