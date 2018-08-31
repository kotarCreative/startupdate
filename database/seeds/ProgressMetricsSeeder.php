<?php

use Illuminate\Database\Seeder;

use App\Models\Companies\Progress\Metric as ProgressMetric;

class ProgressMetricsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $metrics = [
            (object) [
                'name' => 'Revenue in USD',
                'slug' => 'rev-usd'
            ],
            (object) [
                'name' => 'Active Users',
                'slug' => 'active-users'
            ],
            (object) [
                'name' => 'Weeks till Launch',
                'slug' => 'weeks-launch'
            ],
            (object) [
                'name' => 'Other',
                'slug' => 'other'
            ]
        ];

        foreach ($metrics as $metric) {
            ProgressMetric::create([
                'name' => $metric->name,
                'slug' => $metric->slug
            ]);
        }


    }
}
