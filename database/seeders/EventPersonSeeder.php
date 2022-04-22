<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class EventPersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('event_person')->insert(array(
            array(
                'event_id' => 1,
                'person_id' => 2,
            ),
            array(
                'event_id' => 1,
                'person_id' => 4,
            ),

            array(
                'event_id' => 2,
                'person_id' => 2,
            ),
            array(
                'event_id' => 2,
                'person_id' => 4,
            ),
            array(
                'event_id' => 2,
                'person_id' => 8,
            ),

            array(
                'event_id' => 3,
                'person_id' => 2,
            ),
            array(
                'event_id' => 3,
                'person_id' => 4,
            ),
            array(
                'event_id' => 3,
                'person_id' => 5,
            ),

            array(
                'event_id' => 4,
                'person_id' => 2,
            ),

            array(
                'event_id' => 5,
                'person_id' => 2,
            ),

            array(
                'event_id' => 6,
                'person_id' => 2,
            ),
            array(
                'event_id' => 6,
                'person_id' => 5,
            ),
            array(
                'event_id' => 6,
                'person_id' => 6,
            ),
            array(
                'event_id' => 6,
                'person_id' => 7,
            ),

            array(
                'event_id' => 7,
                'person_id' => 5,
            ),
            array(
                'event_id' => 7,
                'person_id' => 6,
            ),
        ));
    }
}
