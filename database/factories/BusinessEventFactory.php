<?php

namespace Database\Factories;

use App\Models\BusinessEvent;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends Factory<BusinessEventFactory>
 */
class BusinessEventFactory extends Factory
{
    protected $model = BusinessEvent::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'place' => $this->faker->word(),
            'started_at' => Carbon::now(),
            'ended_at' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'user_id' => User::factory(),
        ];
    }
}
