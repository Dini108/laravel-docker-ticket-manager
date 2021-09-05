<?php

namespace Database\Factories;

use App\Place;
use App\Performer;
use App\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     */
    protected $model = Event::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $start_time = now()->addHours(rand(1, 100));
        return [
            'name' => 'Event'.rand(1, 100),
            'description' => 'Event description'.rand(1, 100),
            'place_id' => Place::inRandomOrder()->first()->id,
            'performer_id' => Performer::inRandomOrder()->first()->id,
            'start_time' => $start_time->format('Y-m-d H') . ':00',
            'price' => rand(2000, 100000),
            'finish_time' => $start_time->addHours(rand(1, 2))->format('Y-m-d H') . ':00',
        ];
    }
}
