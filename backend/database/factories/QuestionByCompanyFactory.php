<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\QuestionByCompany>
 */
class QuestionByCompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'question_id' => Question::factory(),
            'company_id' => Company::factory(),
        ];
    }
}
