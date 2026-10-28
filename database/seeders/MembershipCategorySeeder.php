<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MembershipCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       DB::table('membership_categories')->insert([
    [
        'name' => 'Student',
        'description' => 'Membership category for students.',
        'is_active' => true,
    ],
    [
        'name' => 'Regular',
        'description' => 'Standard membership category.',
        'is_active' => true,
    ],
    [
        'name' => 'Senior Citizen',
        'description' => 'Membership category for senior citizens.',
        'is_active' => true,
    ],
    [
        'name' => 'Corporate',
        'description' => 'Membership category for corporate members.',
        'is_active' => true,
    ],
]);
    }
}
