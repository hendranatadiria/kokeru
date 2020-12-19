<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Building;
use App\Models\Room;

class RoomFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Room::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->randomElement(['A','B','C']).$this->faker->numberBetween(1,3).$this->faker->randomElement('0','1').$this->faker->numberBetween(1,9),
            'level' => $this->faker->numberBetween(1,5),
        ];
    }
}
