<?php

use App\Models\CourseDetails;
use Illuminate\Database\Seeder;

class CourseDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(CourseDetails::class, 10)->create();
    }
}
