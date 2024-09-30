<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JobCategory;

class JobCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seedConfig = config('models.seeding.job-categories');
        $jobCategories = $seedConfig['default_list'];

        foreach($jobCategories as $jobCategory) {
            JobCategory::updateOrCreate(
                [
                    'name' => $jobCategory['name'],
                    'description' => $jobCategory['description'],
                ],
            );
        }
    }
}
