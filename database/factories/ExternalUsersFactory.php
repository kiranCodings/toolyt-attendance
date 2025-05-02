<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ExternalUsers>
 */
class ExternalUsersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $phoneCount = 0;
    $phoneList = ['9998887770', '9597469631', '9847456321', '9496064321'];

    return [
        'user_id' => \App\Models\InternalUsers::inRandomOrder()->first()?->id ?? 1,
        'phone_2' => $phoneList[$phoneCount++ % count($phoneList)],
        'address' => $this->faker->address,
        'dob' => $this->faker->date('Y-m-d', '2000-01-01'),
        'created_at' => now(),
        'updated_at' => now(),
    ];
    }
}
