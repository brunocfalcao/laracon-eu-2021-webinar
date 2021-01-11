<?php

namespace Database\Factories;

use App\Models\Requester;
use Illuminate\Database\Eloquent\Factories\Factory;

class RequesterFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Requester::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'registration_date' => now()->subMinutes(rand(5 * 1440, 15 * 1440))
        ];
    }
}
