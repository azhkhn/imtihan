<?php

namespace Database\Factories;

use App\Models\Condition;
use App\Models\ConditionCategory;
use App\Models\QuestionCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Condition>
 */
class ConditionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'question_category_id' => QuestionCategory::factory(),
            'condition_category_id' => ConditionCategory::factory(),
            'value' => fake()->randomNumber(),
            'is_active' => Condition::STATUS_ACTIVE,
        ];
    }
}
