<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use DB;

class PointSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('points')->insert(array(
            array(
                'name' => 'TEATRO DE LA CULTURA TARIJA',
                'direction' => 'Av. Junin Casa Dorada',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            array(
                'name' => 'Restaurante EL MARQUÉS',
                'direction' => 'Calle Madrid Plaza Luis de fuentes',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
        ));
    }
}
