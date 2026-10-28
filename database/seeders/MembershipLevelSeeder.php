<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MembershipLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('membership_levels')->insert([
    [
        'name' => 'Basic',
        'fee' => 500.00,
        'validity_period_months' => 6,
        'benefits' => 'Basic membership benefits.',
        'is_active' => true,
    ],
    [
        'name' => 'Silver',
        'fee' => 1000.00,
        'validity_period_months' => 12,
        'benefits' => 'Silver membership benefits.',
        'is_active' => true,
    ],
    [
        'name' => 'Gold',
        'fee' => 1500.00,
        'validity_period_months' => 12,
        'benefits' => 'Gold membership benefits.',
        'is_active' => true,
    ],
    [
        'name' => 'Platinum',
        'fee' => 2500.00,
        'validity_period_months' => 24,
        'benefits' => 'Platinum membership benefits.',
        'is_active' => true,
    ],
]);
    }
}
