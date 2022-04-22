<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use DB;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('events')->insert(array(
            array(
                'name' => 'Concierto para violín y orquesta de Tchaikovsky',
                'description' => 'GRANDES CLÁSICOS (CONCIERTO PARA LA JUVENTUD)',
                'price' => 60,
                'date' => Carbon::createFromFormat('Y-m-d', '2022-04-19'),
                'start_time' => Carbon::createFromFormat('H:i:s', '20:00:00'),
                'end_time' => Carbon::createFromFormat('H:i:s', '21:00:00'),
                'place' => 'Teatro de la Cultura',
                'cover' => '/img/eventos/Concierto para violín y orquesta de Tchaikovsky.jpg',
                'slug' => 'concierto-para-violin-y-orquesta-de-tchaikovsky-1',
                'status' => 1,
                'category_id' => 1,
                'promotion_id' => 1,
                'user_id' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            array(
                'name' => 'Tchaikovsky',
                'description' => 'Violin concierto D Major - Solista: Gabriel Bilbao',
                'price' => 60,
                'date' => Carbon::createFromFormat('Y-m-d', '2022-04-20'),
                'start_time' => Carbon::createFromFormat('H:i:s', '19:00:00'),
                'end_time' => Carbon::createFromFormat('H:i:s', '20:00:00'),
                'place' => 'Teatro de la Cultura',
                'cover' => '/img/eventos/Tchaikovsky.jpg',
                'slug' => 'tchaikovsky-2',
                'status' => 1,
                'category_id' => 1,
                'promotion_id' => 1,
                'user_id' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            array(
                'name' => 'Beethoven Emperador',
                'description' => 'Concierto a Tarija - Abril en la Tierra Chapaca',
                'price' => 50,
                'date' => Carbon::createFromFormat('Y-m-d', '2022-04-21'),
                'start_time' => Carbon::createFromFormat('H:i:s', '18:00:00'),
                'end_time' => Carbon::createFromFormat('H:i:s', '19:00:00'),
                'place' => 'Teatro de la Cultura',
                'cover' => '/img/eventos/Beethoven Emperador.jpg',
                'slug' => 'beethoven-emperador-3',
                'status' => 1,
                'category_id' => 1,
                'promotion_id' => null,
                'user_id' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            array(
                'name' => 'Cuatro estaciones porteñas - Vivaldi Piazolla',
                'description' => 'Violin: Alexander Lapich y Gabriel Bilbao',
                'price' => 30,
                'date' => Carbon::createFromFormat('Y-m-d', '2022-06-28'),
                'start_time' => Carbon::createFromFormat('H:i:s', '19:00:00'),
                'end_time' => Carbon::createFromFormat('H:i:s', '20:00:00'),
                'place' => 'Teatro de la Cultura',
                'cover' => '/img/eventos/Cuatro estaciones porteñas - Vivaldi Piazolla.jpg',
                'slug' => 'cuatro-estaciones-portenas-vivaldi-piazolla-4',
                'status' => 1,
                'category_id' => 1,
                'promotion_id' => null,
                'user_id' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            array(
                'name' => 'Presentación de la Orquesta Vivaldi Tarija',
                'description' => 'Invitación del Gobierno Autónomo Municipal de Tarija',
                'price' => 0,
                'date' => Carbon::createFromFormat('Y-m-d', '2022-05-14'),
                'start_time' => Carbon::createFromFormat('H:i:s', '20:00:00'),
                'end_time' => Carbon::createFromFormat('H:i:s', '21:00:00'),
                'place' => 'Parroquia Nuestra Señora Virgen de Fátima',
                'cover' => '/img/eventos/Presentación de la Orquesta Vivaldi Tarija.jpg',
                'slug' => 'presentacion-de-la-orquesta-vivaldi-tarija-5',
                'status' => 1,
                'category_id' => 1,
                'promotion_id' => null,
                'user_id' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            array(
                'name' => 'Las 4 estaciones Antonio Vivaldi',
                'description' => 'Solista: Alexander Lapich',
                'price' => 40,
                'date' => Carbon::createFromFormat('Y-m-d', '2022-05-21'),
                'start_time' => Carbon::createFromFormat('H:i:s', '20:00:00'),
                'end_time' => Carbon::createFromFormat('H:i:s', '21:00:00'),
                'place' => 'Teatro de la Cultura',
                'cover' => '/img/eventos/Las 4 estaciones Antonio Vivaldi.jpg',
                'slug' => 'las-4-estaciones-antonio-vivaldi-6',
                'status' => 1,
                'category_id' => 1,
                'promotion_id' => 1,
                'user_id' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            array(
                'name' => 'Concierto de Primavera',
                'description' => 'Concierto de primavera para los jovenes',
                'price' => 30,
                'date' => Carbon::createFromFormat('Y-m-d', '2022-09-21'),
                'start_time' => Carbon::createFromFormat('H:i:s', '19:00:00'),
                'end_time' => Carbon::createFromFormat('H:i:s', '20:00:00'),
                'place' => 'Teatro de la Cultura',
                'cover' => '/img/eventos/Concierto de Primavera.jpeg',
                'slug' => 'concierto-de-primavera-7',
                'status' => 1,
                'category_id' => 3,
                'promotion_id' => 1,
                'user_id' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
        ));
    }
}
