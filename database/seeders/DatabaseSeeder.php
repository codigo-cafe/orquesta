<?php

namespace Database\Seeders;

use Database\Seeders\AddressSeeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\ClassificationSeeder;
use Database\Seeders\EventPersonSeeder;
use Database\Seeders\EventPointSeeder;
use Database\Seeders\EventSeeder;
use Database\Seeders\InstrumentSeeder;
use Database\Seeders\MemberSeeder;
use Database\Seeders\OrchestraSeeder;
use Database\Seeders\PersonSeeder;
use Database\Seeders\PhoneSeeder;
use Database\Seeders\PointSeeder;
use Database\Seeders\PromotionSeeder;
use Database\Seeders\ServiceSeeder;
use Database\Seeders\TypeSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            TypeSeeder::class,
            CategorySeeder::class,
            ClassificationSeeder::class,
            InstrumentSeeder::class,
            OrchestraSeeder::class,
            UserSeeder::class,
            PersonSeeder::class,
            MemberSeeder::class,
            PhoneSeeder::class,
            AddressSeeder::class,
            ServiceSeeder::class,
            PromotionSeeder::class,
            EventSeeder::class,
            PointSeeder::class,
            EventPersonSeeder::class,
            EventPointSeeder::class,
        ]);
    }
}
