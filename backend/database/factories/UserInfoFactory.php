<?php

namespace Database\Factories;

use App\Models\ClassRoom;
use App\Models\Company;
use App\Models\Language;
use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserInfo>
 */
class UserInfoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'is_active' => UserInfo::STATUS_ACTIVE,
            'start_date' => fake()->date(),
            'end_date' => fake()->date(),
            'class_id' => 1, ClassRoom::factory(),
            'language_id' => Language::factory(),
            'company_id' => Company::factory(),
            'user_id' => User::factory(),
        ];
    }
}
