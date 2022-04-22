<?php

namespace Database\Seeders;

use App\Models\Orchestra;
use Carbon\Carbon;
use DB;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('members')->insert(array(
            array(
                'instrument_id' => 1,
                'orchestra_id' => Orchestra::first()->id,
                'person_id' => 4,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            array(
                'instrument_id' => 2,
                'orchestra_id' => Orchestra::first()->id,
                'person_id' => 5,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            array(
                'instrument_id' => 3,
                'orchestra_id' => Orchestra::first()->id,
                'person_id' => 6,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            array(
                'instrument_id' => 4,
                'orchestra_id' => Orchestra::first()->id,
                'person_id' => 7,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            array(
                'instrument_id' => 5,
                'orchestra_id' => Orchestra::first()->id,
                'person_id' => 8,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            array(
                'instrument_id' => 6,
                'orchestra_id' => Orchestra::first()->id,
                'person_id' => 9,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
        ));
    }
}
