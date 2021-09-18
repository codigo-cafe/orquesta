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
                'name' => 'Concierto de Primavera',
                'description' => 'GRANDES CLÁSICOS (CONCIERTO PARA LA JUVENTUD)',
                'price' => 30,
                'date' => Carbon::createFromFormat('Y-m-d', '2021-09-21'),
                'start_time' => Carbon::createFromFormat('H:i:s', '19:30:00'),
                'end_time' => Carbon::createFromFormat('H:i:s', '21:30:00'),
                'place' => 'Teatro de la Cultura',
                'cover' => '/img/eventos/concierto de primavera.jpg',
                'slug' => 'concierto-de-primavera',
                'status' => 1,
                'category_id' => 3,
                'promotion_id' => null,
                'user_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
        ));
    }
}
