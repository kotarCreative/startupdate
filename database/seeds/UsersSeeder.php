<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\User::class, 50)->create()
            ->each(function ($u) {
                $u->companies()->save(factory(App\Models\Companies\Company::class)->make());
            });
    }
}
