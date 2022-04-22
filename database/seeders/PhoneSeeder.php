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
        DB::table('phones')->insert(array(
            array(
                'number' => '+591 78249694',
                'person_id' => 1,
            ),
            array(
                'number' => '+591 72962410',
                'person_id' => 2,
            ),
            array(
                'number' => '+591 60659854',
                'person_id' => 3,
            ),
            array(
                'number' => '+591 71458487',
                'person_id' => 4,
            ),
            array(
                'number' => '+591 74845499',
                'person_id' => 5,
            ),
            array(
                'number' => '+591 65457812',
                'person_id' => 6,
            ),
            array(
                'number' => '+591 77875498',
                'person_id' => 7,
            ),
            array(
                'number' => '+591 76599878',
                'person_id' => 8,
            ),
            array(
                'number' => '+591 73654411',
                'person_id' => 9,
            ),
        ));
    }
}
