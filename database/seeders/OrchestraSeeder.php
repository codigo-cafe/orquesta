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
                'description' => 'description orchestra.',
                'mission' => 'mission orchestra.',
                'vission' => 'vission orchestra.',
                'email' => 'orquesta@hotmail.com',
                'phone' => '+591 87978941',
                'direction' => 'Calle Loa Nro 418 entre Hernando Siles y Ravelo (Tarija)',
                'banner' => '/img/banner.jpg',
                'latitude' => '-19.044052',
                'longitude' => '-65.260376',
                'iframe' => '<iframe width="560" height="315" src="https://www.youtube.com/embed/NgoDgwNN_FY" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
        ));
    }
}
