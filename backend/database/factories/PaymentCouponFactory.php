<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PaymentCoupon>
 */
class PaymentCouponFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'code' => fake()->currencyCode(),
            'discount' => fake()->randomNumber(),
            'start_date' => fake()->date(),
            'end_date' => fake()->date(),
        ];
    }
}
