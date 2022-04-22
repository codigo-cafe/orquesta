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
                'name' => 'Teatro de la cultura Tarija',
                'direction' => 'Av. Junin Casa Dorada',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            array(
                'name' => 'Restaurante El Marques',
                'direction' => 'Calle Madrid Plaza Luis de fuentes',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            array(
                'name' => 'Hotel Miraflores',
                'direction' => 'Av La paz esquina Belgrano',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            array(
                'name' => 'Excalibur Pub',
                'direction' => 'Calle Junin entre Bolívar e Ingavi',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            array(
                'name' => 'Hotel Boutique Vendimia',
                'direction' => "Calle O'Connor entre calle Ingavi y la Madrid",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            array(
                'name' => 'Farmacia Villa Nueva',
                'direction' => "Calle Junin entre Bolívar",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
        ));
    }
}
