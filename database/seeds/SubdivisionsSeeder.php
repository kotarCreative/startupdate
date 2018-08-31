<?php

use Illuminate\Database\Seeder;

use App\Models\Locations\Subdivision;

class SubdivisionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subdivisions = [
            (object) [
                'country_id' => 1,
                'name' => 'British Columbia',
                'abbreviation' => 'BC'
            ],
            (object) [
                'country_id' => 1,
                'name' => 'Alberta',
                'abbreviation' => 'AB'
            ],
            (object) [
                'country_id' => 1,
                'name' => 'Saskatchewan',
                'abbreviation' => 'SK'
            ],
            (object) [
                'country_id' => 1,
                'name' => 'Manitoba',
                'abbreviation' => 'MB'
            ],
            (object) [
                'country_id' => 1,
                'name' => 'Ontario',
                'abbreviation' => 'ON'
            ],
            (object) [
                'country_id' => 1,
                'name' => 'Quebec',
                'abbreviation' => 'QC'
            ],
            (object) [
                'country_id' => 1,
                'name' => 'Newfoundland and Labrador',
                'abbreviation' => 'NL'
            ],
            (object) [
                'country_id' => 1,
                'name' => 'New Brunswick',
                'abbreviation' => 'NB'
            ],
            (object) [
                'country_id' => 1,
                'name' => 'Nova Scotia',
                'abbreviation' => 'NS'
            ],
            (object) [
                'country_id' => 1,
                'name' => 'Prince Edward Island',
                'abbreviation' => 'PE'
            ],
            (object) [
                'country_id' => 1,
                'name' => 'Yukon',
                'abbreviation' => 'YT'
            ],
            (object) [
                'country_id' => 1,
                'name' => 'Northwest Territories',
                'abbreviation' => 'NT'
            ],
            (object) [
                'country_id' => 1,
                'name' => 'Nunavut',
                'abbreviation' => 'NU'
            ]
        ];

        foreach ($subdivisions as $subdivision) {
            Subdivision::create([
                'country_id' => $subdivision->country_id,
                'name' => $subdivision->name,
                'abbreviation' => $subdivision->abbreviation
            ]);
        }
    }
}
