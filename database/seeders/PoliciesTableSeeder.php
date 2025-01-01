<?php

namespace Database\Seeders;

use App\Models\Policy;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PoliciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Policy::create([
            'title'=>'Privacy Policy',
            'privacy_policy' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aliquam, animi perspiciatis incidunt cum, aliquid, laborum architecto quas corporis tenetur adipisci ducimus impedit corrupti et sint eaque accusantium! Voluptate, aliquam sapiente, alias, doloribus illum porro nesciunt quidem ipsa inventore ut tempora. Fugit neque impedit ullam quidem quis. Consectetur incidunt quas beatae et voluptatibus asperiores magni placeat culpa eius nisi. Veniam magni, assumenda perferendis eligendi, facere recusandae inventore laborum dolorum facilis consequatur consectetur distinctio quam a aspernatur? Ipsam magni sit eveniet quaerat autem porro natus officia! Sint corrupti eligendi sequi dolorum itaque eum sunt blanditiis accusantium! Quo sint reprehenderit eius consectetur. Magni.',
        ]);
    }
}
