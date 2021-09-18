<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Classification;
use App\Models\Instrument;
use App\Models\Person;
use App\Models\Promotion;
use App\Models\Service;
use App\Models\Type;
use App\Models\User;
use Database\Seeders\AddressSeeder;
use Database\Seeders\EventPersonSeeder;
use Database\Seeders\EventPointSeeder;
use Database\Seeders\EventSeeder;
use Database\Seeders\MemberSeeder;
use Database\Seeders\OrchestraSeeder;
use Database\Seeders\PersonSeeder;
use Database\Seeders\PhoneSeeder;
use Database\Seeders\PointSeeder;
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
        Type::factory(10)->create();
        Category::factory(10)->create();
        Classification::factory(10)->create();
        Instrument::factory(10)->create();
        $this->call([
            OrchestraSeeder::class,
            UserSeeder::class,
            PersonSeeder::class,
            MemberSeeder::class,
            PhoneSeeder::class,
            AddressSeeder::class,
        ]);
        Service::factory(10)->create();
        Promotion::factory(10)->create();
        $this->call([
            EventSeeder::class,
            PointSeeder::class,
            EventPointSeeder::class,
            EventPersonSeeder::class,
        ]);
    }
}
