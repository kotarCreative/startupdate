<?php

use Illuminate\Database\Seeder;

use App\Models\Companies\Company;

class ProgressUpdatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = Company::all()->count();

        for ($i = 0; $i < 10; $i++) {
            factory(App\Models\Companies\Progress\Update::class, rand(0, 10))->create([
                'company_id' => rand(1, $count)
            ]);
        }
    }
}
