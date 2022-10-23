<?php

namespace Database\Factories;

use App\Models\Language;
use App\Models\Question;
use App\Models\QuestionCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
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
            'description' => fake()->text(),
            'category_id' => QuestionCategory::factory(),
            'is_option' => Question::STATUS_INACTIVE,
            'src' => fake()->imageUrl(),
            'language_id' => Language::factory(),
        ];
    }
}
