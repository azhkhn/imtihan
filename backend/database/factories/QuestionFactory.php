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
            'name' => $this->faker->name,
            'description' => $this->faker->name,
            'category_id' => QuestionCategory::factory(),
            'is_option' => Question::STATUS_INACTIVE,
            'src' => $this->faker->imageUrl,
            'language_id' => Language::factory(),
        ];
    }
}
