<?php

use Illuminate\Database\Seeder;

use App\Models\Locations\Country;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::create([
            'name' => 'Canada',
            'abbreviation' => 'CND'
        ]);

        Country::create([
            'name' => 'United States of America',
            'abbreviation' => 'USA'
        ]);
    }
}
