<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Notification;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notification>
 */
class NotificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'message' => $this->faker->text,
            'is_active' => Notification::STATUS_ACTIVE,
            'company_id' => Company::factory(),
        ];
    }
}
