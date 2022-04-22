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
        DB::table('people')->insert(array(
            array(
                'name' => 'Sandra',
                'surnames' => 'Gutierrez',
                'profile_photo_path' => null,
                'type_id' => 11,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            array(
                'name' => 'Juan',
                'surnames' => 'Cárdenas Veizaga',
                'profile_photo_path' => null,
                'type_id' => 11,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            array(
                'name' => 'Patricia',
                'surnames' => 'Maldonado Figueroa',
                'profile_photo_path' => null,
                'type_id' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            array(
                'name' => 'Belen',
                'surnames' => 'Perez',
                'profile_photo_path' => null,
                'type_id' => 11,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            array(
                'name' => 'Maximiliano',
                'surnames' => 'Farfán',
                'profile_photo_path' => null,
                'type_id' => 11,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            array(
                'name' => 'Elías',
                'surnames' => 'Sagredo Vidal',
                'profile_photo_path' => null,
                'type_id' => 11,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
        ));
    }
}
