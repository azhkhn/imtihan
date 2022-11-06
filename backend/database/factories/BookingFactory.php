<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'description' => $this->faker->text,
            'date' => $this->faker->date,
            'is_active' => Booking::STATUS_ACTIVE,
            'teacher_id' => User::factory(),
            'user_id' => User::factory(),
            'company_id' => Company::factory(),
        ];
    }
}
