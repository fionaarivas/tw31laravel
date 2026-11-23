<?php

namespace Database\Factories;

use App\Models\Member;
use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Task>
 */
class TaskFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'member_id' => Member::factory(),
            'task_title' => fake()->sentence(4),
            'description' => fake()->paragraph(),
            'status' => Task::STATUS_PENDING,
        ];
    }

    public function inProgress(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => Task::STATUS_IN_PROGRESS,
        ]);
    }

    public function completed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => Task::STATUS_COMPLETED,
        ]);
    }
}
