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
            'extra_information' => ['Total Credits' => rand(10, 65433)],
            'address_line_1' => $this->faker->streetAddress(),
            'city' => $this->faker->city(),
            'state' => $this->faker->state(),
            'postal_code' => $this->faker->postcode(),
            'country' => $this->faker->countryCode(),
            'registration_date' => now()->subMinutes(rand(5 * 1440, 15 * 1440)),
        ];
    }
}
