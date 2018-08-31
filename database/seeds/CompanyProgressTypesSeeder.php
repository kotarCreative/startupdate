<?php

use Illuminate\Database\Seeder;

use App\Models\Companies\Progress\Type as ProgressType;

class CompanyProgressTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            (object) [
                'name' => 'Mocks/Renderings',
                'slug' => 'renderings',
            ],
            (object) [
                'name' => 'Prototype/Pre-Launch',
                'slug' => 'prototype',
            ],
            (object) [
                'name' => 'Private Beta',
                'slug' => 'private-beta',
            ],
            (object) [
                'name' => 'Public Beta',
                'slug' => 'private-beta',
            ],
            (object) [
                'name' => 'Taking Preorders',
                'slug' => 'preorder',
            ],
            (object) [
                'name' => 'Launched',
                'slug' => 'launch',
            ]
        ];

        foreach ($types as $type) {
            ProgressType::create([
                'name' => $type->name,
                'slug' => $type->slug
            ]);
        }


    }
}
