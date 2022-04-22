<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use DB;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('services')->insert(array(
            array(
                'name' => 'Eventos al aire libre',
                'description' => 'Eventos de acceso libre o exclusivos',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            array(
                'name' => 'Eventos sociales',
                'description' => 'Servicios de música para todo tipo de eventos sociales.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            array(
                'name' => 'Conciertos',
                'description' => 'Conciertos inolvidables de las cuatro estaciones de Antonio Vivaldi y las cuatro estaciones Porteñas de Astor Piazzolla',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            array(
                'name' => 'Espectáculos',
                'description' => 'Servicio que brinda la orquesta para cualquier acontecimiento social.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            array(
                'name' => 'Serenatas',
                'description' => 'Serenatas a gusto de los solicitantes en cualquier horario programado',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
        ));
    }
}
