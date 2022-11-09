<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Lesson;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LessonByCompany>
 */
class LessonByCompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'lesson_id' => Lesson::factory(),
            'company_id' => Company::factory(),
        ];
    }
}
