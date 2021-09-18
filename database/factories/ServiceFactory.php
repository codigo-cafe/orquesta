<?php

namespace Database\Factories;

use App\Models\Orchestra;
use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Service::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->realText($maxNbChars = 200, $indexSize = 2),
            'status' => true,
            'orchestra_id' => Orchestra::first()->id,
        ];
    }
}
