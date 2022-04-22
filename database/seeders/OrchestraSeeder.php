<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use DB;

class OrchestraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orchestra')->insert(array(
            array(
                'name' => 'Orquesta Vivaldi Tarija',
                'description' => 'Comprometidos con la democratización de las artes.',
                'mission' => 'Fomentar, promover y difundir la cultura musical en Bolivia.',
                'vission' => 'Ser el referente fundamental de la cultura musical sinfónica boliviana en el ámbito nacional, promoviendo el desarrollo artístico profesional, la investigación e interpretación musical de compositores universales y nacionales.',
                'email' => 'orquesta.vivalditarija@gmail.com',
                'phone' => '+591 72962410',
                'direction' => 'Calle Sucre y 15 de Abril - Patio del Cabildo (Tarija)',
                'banner' => '/img/banner.jpg',
                'latitude' => '-21.534587',
                'longitude' => '-64.734228',
                'iframe' => '<iframe width="560" height="315" src="https://www.youtube.com/embed/ydd-pu0Mzn8" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
        ));
    }
}
