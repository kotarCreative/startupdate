<?php

use Illuminate\Database\Seeder;

use App\Models\Companies\Vertical;

class VerticalsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $verticals = [
            (object) [
                'name' => 'Agriculture / Agtech',
                'slug' => 'agriculture'
            ],
            (object) [
                'name' => 'Artificial Intelligence',
                'slug' => 'artificial-intelligence'
            ],
            (object) [
                'name' => 'Augmented Reality',
                'slug' => 'augmented-reality'
            ],
            (object) [
                'name' => 'Business to Business',
                'slug' => 'b-to-b'
            ],
            (object) [
                'name' => 'Biotech',
                'slug' => 'biotech'
            ],
            (object) [
                'name' => 'Blockchain',
                'slug' => 'blockchain'
            ],
            (object) [
                'name' => 'Community',
                'slug' => 'community'
            ],
            (object) [
                'name' => 'Consumer',
                'slug' => 'consumer'
            ],
            (object) [
                'name' => 'Crowdfunding',
                'slug' => 'crowdfunding'
            ],
            (object) [
                'name' => 'Consumer',
                'slug' => 'consumer'
            ],
            (object) [
                'name' => 'Developer Tools',
                'slug' => 'dev-tools'
            ],
            (object) [
                'name' => 'Diversity',
                'slug' => 'diversity'
            ],
            (object) [
                'name' => 'Drones',
                'slug' => 'drones'
            ],
            (object) [
                'name' => 'E-commerce',
                'slug' => 'ecommerce'
            ],
            (object) [
                'name' => 'Education',
                'slug' => 'education'
            ],
            (object) [
                'name' => 'Energy',
                'slug' => 'energy'
            ],
            (object) [
                'name' => 'Enterprise',
                'slug' => 'enterprise'
            ],
            (object) [
                'name' => 'Entertainment',
                'slug' => 'entertainment'
            ],
            (object) [
                'name' => 'Esports / Online Gaming',
                'slug' => 'esports'
            ],
            (object) [
                'name' => 'Financial / Banking',
                'slug' => 'financial'
            ],
            (object) [
                'name' => 'Government',
                'slug' => 'government'
            ],
            (object) [
                'name' => 'Hardware',
                'slug' => 'hardware'
            ],
            (object) [
                'name' => 'Healthcare',
                'slug' => 'healthcare'
            ],
            (object) [
                'name' => 'International Market',
                'slug' => 'international-market'
            ],
            (object) [
                'name' => 'Jobs',
                'slug' => 'jobs'
            ],
            (object) [
                'name' => 'Marketplace',
                'slug' => 'marketplace'
            ],
            (object) [
                'name' => 'Media / Advertising',
                'slug' => 'media'
            ],
            (object) [
                'name' => 'Moonshots / Hard Tech',
                'slug' => 'hard-tech'
            ],
            (object) [
                'name' => 'Nonprofit',
                'slug' => 'nonprofit'
            ],
            (object) [
                'name' => 'Other',
                'slug' => 'other'
            ],
            (object) [
                'name' => 'Robotics',
                'slug' => 'robotics'
            ],
            (object) [
                'name' => 'Science',
                'slug' => 'science'
            ],
            (object) [
                'name' => 'Security',
                'slug' => 'security'
            ],
            (object) [
                'name' => 'Sport / Fitness',
                'slug' => 'fitness'
            ],
            (object) [
                'name' => 'Transportation',
                'slug' => 'transport'
            ],
            (object) [
                'name' => 'Travel',
                'slug' => 'travel'
            ],
            (object) [
                'name' => 'Virtual Reality',
                'slug' => 'virtual-reality'
            ]
        ];

        foreach ($verticals as $vertical) {
            Vertical::create([
                'name' => $vertical->name,
                'slug' => $vertical->slug
            ]);
        }
    }
}
