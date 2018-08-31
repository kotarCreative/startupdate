<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CountriesSeeder::class);
        $this->call(SubdivisionsSeeder::class);
        $this->call(VerticalsSeeder::class);
        $this->call(CompanyProgressTypesSeeder::class);
        $this->call(ProgressMetricsSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(ProgressUpdatesSeeder::class);
    }
}
