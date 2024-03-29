<?php

namespace Database\Factories;

use App\Models\Promotion;
use Illuminate\Database\Eloquent\Factories\Factory;

class PromotionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Promotion::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->realText($maxNbChars = 200),
            'discount' => $this->faker->numberBetween($min = 10, $max = 100),
            'date_start' => $this->faker->dateTime($max = 'now', $timezone = null),
            'date_end' => $this->faker->dateTime($max = 'now', $timezone = null),
            'status' => true,
        ];
    }
}
