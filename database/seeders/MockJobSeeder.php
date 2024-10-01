<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Job;
use Illuminate\Support\Facades\File;

class MockJobSeeder extends Seeder
{
    public function run()
    {
        // Path to the mock.json file
        $jsonPath = database_path('data/mock.json');
        
        // Read the JSON file
        if (File::exists($jsonPath)) {
            $jsonData = File::get($jsonPath);
            $jobs = json_decode($jsonData, true);

            // Loop through the jobs and insert them into the database
            foreach ($jobs as $job) {
                Job::create([
                    'title' => $job['title'],
                    'location' => $job['location'],
                    'job_type' => $job['job_type'],
                    'employer_id' => null, // For mock jobs, employer_id is null
                ]);

            }
        } else {
            $this->command->error('mock.json file not found!');
        }
    }
}
