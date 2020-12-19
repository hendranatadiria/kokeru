<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Cleaningservice;
use App\Models\Responsibility;
use App\Models\Room;

class ResponsibilityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Responsibility::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'cleaning_service_id' => $this->faker->numberBetween(1,15),
            'room_id' => Room::factory(),
            'assigned_from' => '2020-01-01',
            'assigned_to' => '2020-12-31',
        ];
    }
}
