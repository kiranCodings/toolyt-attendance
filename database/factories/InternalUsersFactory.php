<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InternalUsers>
 */
class InternalUsersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
            static $emailCount = 0;
            $emailList = ['anusree@toolyt.com', 'ligi@toolyt.com', 'salman@toolyt.com', 'user@toolyt.com'];
            $phoneList = ['9998887770', '9597469631', '9847456321', '9496064321'];
        
            return [
                'username' => $this->faker->userName,
                'email' => $emailList[$emailCount++ % count($emailList)],
                'phone' => $phoneList[$emailCount % count($phoneList)],
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ];
    }
}
