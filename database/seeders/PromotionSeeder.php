<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use DB;

class PromotionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('promotions')->insert(array(
            array(
                'name' => 'Preventa',
                'description' => 'Disponibilidad de entradas para preventa la cual incluye un descuento',
                'discount' => 10,
                'date_start' => Carbon::createFromFormat('Y-m-d', '2022-01-01'),
                'date_end' => Carbon::createFromFormat('Y-m-d', '2022-12-31'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            array(
                'name' => 'Aniversario de la Orquesta',
                'description' => 'Descuento único en el año para festejar junto a la Orquesta Vivaldi Tarija',
                'discount' => 15,
                'date_start' => Carbon::createFromFormat('Y-m-d', '2022-06-15'),
                'date_end' => Carbon::createFromFormat('Y-m-d', '2022-06-15'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            array(
                'name' => 'Aniversario de Tarija',
                'description' => 'El 15 de abril se recuerda la Batalla de la Tablada, que se combatió en 1817 en las proximidades de la ciudad de Tarija',
                'discount' => 20,
                'date_start' => Carbon::createFromFormat('Y-m-d', '2022-04-14'),
                'date_end' => Carbon::createFromFormat('Y-m-d', '2022-14-15'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            array(
                'name' => 'Fin de año',
                'description' => 'Promoción disponible para el mes de diciembre',
                'discount' => 5,
                'date_start' => Carbon::createFromFormat('Y-m-d', '2022-12-01'),
                'date_end' => Carbon::createFromFormat('Y-m-d', '2022-12-31'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
        ));
    }
}
