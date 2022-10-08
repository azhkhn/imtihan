<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\PaymentCoupon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
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
            'start_date' => fake()->date(),
            'end_date' => fake()->date(),
            'discount' => fake()->randomNumber(),
            'total' => fake()->randomNumber(),
            'paid_at' => fake()->dateTime(),
            'payment_coupon_id' => PaymentCoupon::factory(),
            'company_id' => Company::factory(),
        ];
    }
}
