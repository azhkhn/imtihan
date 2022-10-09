<?php

namespace Database\Factories;

use App\Models\PaymentSetting;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PaymentSetting>
 */
class PaymentSettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'price' => fake()->randomNumber(),
            'is_default' => PaymentSetting::STATUS_ACTIVE,
        ];
    }
}