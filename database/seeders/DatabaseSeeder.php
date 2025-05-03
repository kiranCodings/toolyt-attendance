<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\ExternalUsers;
use App\Models\InternalUsers;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();


        echo "Seeding 4 InternalUsers...\n";
        InternalUsers::factory(4)->create();

        echo "Seeding 4 ExternalUsers...\n";
        ExternalUsers::factory(4)->create();

        $count = 50; // number of records
        echo "Seeding $count Attendance records...\n";
        Attendance::factory($count)->create();
    
    }
}
