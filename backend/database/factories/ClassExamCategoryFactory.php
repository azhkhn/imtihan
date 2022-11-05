<?php

namespace Database\Factories;

use App\Models\ClassExam;
use App\Models\QuestionCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ClassExamCategory>
 */
class ClassExamCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'class_exam_id' => ClassExam::factory(),
            'category_id' => QuestionCategory::factory(),
            'length' => $this->faker->randomNumber,
        ];
    }
}
