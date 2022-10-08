<?php

namespace Database\Factories;

use App\Models\Language;
use App\Models\QuestionCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lesson>
 */
class LessonFactory extends Factory
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
            'content' => fake()->text(),
            'category_id' => QuestionCategory::factory(),
            'language_id' => Language::factory(),
        ];
    }
}
