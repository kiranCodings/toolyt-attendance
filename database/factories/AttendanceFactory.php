<?php

namespace Database\Factories;

use App\Models\ExternalUsers;
use App\Models\InternalUsers;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attendance>
 */
class AttendanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Pick a random day in the past 30 days
        $loginDay = Carbon::now()->subDays(rand(1, 30));

        // Set login time between 7 AM and 11 AM
        $login = $loginDay->copy()->setTime(rand(7, 11), rand(0, 59));

        // Logout is 1 to 8 hours after login
        $logout = $login->copy()->addHours(rand(1, 8))->addMinutes(rand(0, 59));

        // Randomly assign to internal or external user
        $isInternal = $this->faker->boolean;

        return [
            'internal_user_id' => $isInternal ? InternalUsers::inRandomOrder()->value('id') : null,
            'external_user_id' => $isInternal ? null : ExternalUsers::inRandomOrder()->value('id'),
            'login_time' => $login,
            'logout_time' => $logout,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
