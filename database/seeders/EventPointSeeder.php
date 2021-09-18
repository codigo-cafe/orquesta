<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class EventPointSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('event_point')->insert(array(
            array(
                'event_id' => 1,
                'point_id' => 1,
            ),
            array(
                'event_id' => 1,
                'point_id' => 2,
            ),
        ));
    }
}
