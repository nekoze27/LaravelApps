<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Job;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seedConfig =  config('models.seeding.jobs');

        $jobsItems = $seedConfig['default_jobs'];

        foreach ($jobsItems as $jobsItem) {
            Job::updateOrCreate(
                [
                    'title' => $jobsItem['title'],
                ],
                [
                    'company' => $jobsItem['company'],
                    'description' => $jobsItem['description'],
                    'location' => $jobsItem['location'],
                    'type' => $jobsItem['type'],
                    'salary' => $jobsItem['salary'],
                    'application_deadline' => $jobsItem['application_deadline'],
                ]
            );
        }

        $useFactory = $seedConfig['factory'];
        $factoryCount = $seedConfig['factory_count'];

        if ($useFactory) {
            Job::factory()->count($factoryCount)->create();
        }
    }
}
