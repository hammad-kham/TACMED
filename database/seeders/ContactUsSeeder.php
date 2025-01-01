<?php

namespace Database\Seeders;

use App\Models\ContactUs;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ContactUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ContactUs::create([
            'email' => 'tacmedacademy@support.com',
            'phone_no' => '602-434-232-232',
            'description' => 'This is a sample description about TacMed Academy. We provide training and support in medical services...',
        ]);
    }
}
