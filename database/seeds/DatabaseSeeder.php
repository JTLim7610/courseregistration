<?php

use App\Models\CourseDetails;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(
            [
                UserSeeder::class, 
                CourseDetailsSeeder::class,
                CourseSeeder::class
            ]);
    }
}
