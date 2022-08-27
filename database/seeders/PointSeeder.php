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
                'latitude' => -21.53271,
                'longitude' => -64.73395,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            array(
                'name' => 'Restaurante El Marques',
                'direction' => 'Calle Madrid Plaza Luis de fuentes',
                'latitude' => -21.53344,
                'longitude' => -64.73419,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            array(
                'name' => 'Hostal Miraflores',
                'direction' => 'Calle Sucre entre Domingo Paz y Corrado #920',
                'latitude' => -21.53117,
                'longitude' => -64.73282,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            array(
                'name' => 'Excalibur Pub',
                'direction' => 'Calle Junin entre Bolívar e Ingavi',
                'latitude' => -21.53451,
                'longitude' => -64.72758,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            array(
                'name' => 'Hotel Boutique Vendimia',
                'direction' => "Calle O'Connor entre calle Ingavi y la Madrid",
                'latitude' => -21.53552,
                'longitude' => -64.72657,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            array(
                'name' => 'Farmacia Villa Nueva',
                'direction' => "Avenida La Paz esquina Oruro",
                'latitude' => -21.53500,
                'longitude' => -64.72292,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
        ));
    }
}
