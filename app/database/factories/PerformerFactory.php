<?php

namespace Database\Factories;

use App\Performer;
use Illuminate\Database\Eloquent\Factories\Factory;

class PerformerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     */
    protected $model = Performer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'phone' => $this->faker->phoneNumber,
        ];
    }
}
