<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Client::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'client_name' => $this->faker->unique()->name(),
            'address1' => $this->faker->address(),
            'address2' => $this->faker->address(),
            'city' => $this->faker->city(),
            'state' => 'STATE',
            'country' => $this->faker->century(),
            'zip' => $this->faker->numberBetween( 0, 999999),
            'phone_no1' => $this->faker->phoneNumber(),
            'phone_no2' => $this->faker->phoneNumber(),
        ];
    }
}
