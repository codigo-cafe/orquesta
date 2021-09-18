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
                'person_id' => 1,
            ),
            array(
                'event_id' => 1,
                'person_id' => 2,
            ),
        ));
    }
}
