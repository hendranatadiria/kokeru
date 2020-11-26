<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\CleaningHistory;
use App\Models\Cleaningservice;
use App\Models\Responsibility;
use App\Models\Room;

class CleaningHistoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CleaningHistory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'room_id' => Room::factory(),
            'cleaning_service_id' => Cleaningservice::factory(),
            'responsibility_id' => Responsibility::factory(),
            'proof_1' => $this->faker->word,
            'proof_2' => $this->faker->word,
            'proof_3' => $this->faker->word,
            'proof_4' => $this->faker->word,
            'proof_5' => $this->faker->word,
        ];
    }
}
