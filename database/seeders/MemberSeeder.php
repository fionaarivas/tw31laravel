<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('members')->insert([
    [
        'membership_number' => 'MEM-0001',
        'name' => 'Eren Yeager',
        'email' => 'eren@example.com',
        'phone_number' => '09171234567',
        'address' => 'Shiganshina District',
        'membership_category_id' => 1,
        'membership_level_id' => 1,
        'status' => 'active',
    ],
    [
        'membership_number' => 'MEM-0002',
        'name' => 'Mikasa Ackerman',
        'email' => 'mikasa@example.com',
        'phone_number' => '09181234567',
        'address' => 'Shiganshina District',
        'membership_category_id' => 2,
        'membership_level_id' => 2,
        'status' => 'active',
    ],
    [
        'membership_number' => 'MEM-0003',
        'name' => 'Levi Ackerman',
        'email' => 'levi@example.com',
        'phone_number' => '09191234567',
        'address' => 'Trost District',
        'membership_category_id' => 3,
        'membership_level_id' => 3,
        'status' => 'active',
    ],
]);
    }
}
