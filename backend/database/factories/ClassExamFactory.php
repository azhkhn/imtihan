<?php

namespace Database\Factories;

use App\Models\ClassExam;
use App\Models\ClassRoom;
use App\Models\Company;
use App\Models\Exam;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ClassExam>
 */
class ClassExamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'exam_id' => Exam::factory(),
            'company_id' => Company::factory(),
            'class_id' => ClassRoom::factory(),
            'is_active' => ClassExam::STATUS_ACTIVE,
        ];
    }
}
