<?php

namespace Database\Factories;

use App\Models\ClassRoom;
use App\Models\Company;
use App\Models\QuestionCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LiveLesson>
 */
class LiveLessonFactory extends Factory
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
            'date' => fake()->date(),
            'url' => fake()->url(),
            'class_id' => ClassRoom::factory(),
            'question_category_id' => QuestionCategory::factory(),
            'company_id' => Company::factory(),
        ];
    }
}
