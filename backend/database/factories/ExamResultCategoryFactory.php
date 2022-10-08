<?php

namespace Database\Factories;

use App\Models\Exam;
use App\Models\QuestionCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ExamResultCategory>
 */
class ExamResultCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'total_questions' => fake()->randomNumber(),
            'correct' => fake()->randomNumber(),
            'in_correct' => fake()->randomNumber(),
            'blank' => fake()->randomNumber(),
            'category_id' => QuestionCategory::factory(),
            'exam_id' => Exam::factory(),
            'user_id' => User::factory(),
        ];
    }
}
