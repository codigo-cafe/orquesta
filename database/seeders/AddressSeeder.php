<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        DB::table('addresses')->insert(array(
            array(
                'neighborhood' => 'La Pampa',
                'streets' => 'Calle Bolivar esquina Junin',
                'number' => 456,
                'person_id' => 1,
            ),
            array(
                'neighborhood' => 'San Roque',
                'streets' => 'Calle Cochabamba esquina Campero',
                'number' => 231,
                'person_id' => 2,
            ),
            array(
                'neighborhood' => 'Constructor',
                'streets' => 'Av. Salinas esquina avenida Nestor Paz',
                'number' => 744,
                'person_id' => 3,
            ),
            array(
                'neighborhood' => 'El Molino',
                'streets' => 'Calle La Madrid entre Sevilla y Ramón Rojas',
                'number' => 789,
                'person_id' => 4,
            ),
            array(
                'neighborhood' => 'Las Panosas',
                'streets' => 'Calle Virginio Lema entre Méndez y Delgadillo',
                'number' => 541,
                'person_id' => 5,
            ),
            array(
                'neighborhood' => 'La Loma de San Juan',
                'streets' => 'Calle Ramón Rojas esquina Corrado',
                'number' => 268,
                'person_id' => 6,
            ),
            array(
                'neighborhood' => 'Virgen de Fátima',
                'streets' => "Calle Defil Pino entre Av. La Paz y Raquel D' Arlach (lado de Derechos Reales)",
                'number' => 765,
                'person_id' => 7,
            ),
            array(
                'neighborhood' => 'El Molino',
                'streets' => 'Av. Victor Paz Estenssoro entre Ballivián y Juan Misael Saracho',
                'number' => 354,
                'person_id' => 8,
            ),
            array(
                'neighborhood' => 'La Pampa',
                'streets' => "Av. Potosí entre O'connor y Domingo Paz",
                'number' => 159,
                'person_id' => 9,
            ),
        ));
    }
}
