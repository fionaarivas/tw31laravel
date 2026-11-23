<?php

namespace Database\Factories;

use App\Models\MembershipLevel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<MembershipLevel>
 */
class MembershipLevelFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->words(3, true),
            'fee' => fake()->randomFloat(2, 100, 5000),
            'validity_period_months' => 12,
            'benefits' => fake()->sentence(),
            'is_active' => true,
        ];
    }
}
