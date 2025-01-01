<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OnboardingPagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('onboarding_pages')->insert([
            [
                'title' => 'Welcome',
                'description' => 'Welcome to our app. Here\'s how it works...',
                'image' => 'https://example.com/image1.png',
                'button_text' => 'Next',
                'order' => 1
            ],
            [
                'title' => 'Features',
                'description' => 'Our app offers these amazing features...',
                'image' => 'https://example.com/image2.png',
                'button_text' => 'Next',
                'order' => 2
            ],
            [
                'title' => 'Get Started',
                'description' => 'You\'re all set to start using the app!',
                'image' => 'https://example.com/image3.png',
                'button_text' => 'Next',
                'order' => 3
            ]
        ]);
    }
}
