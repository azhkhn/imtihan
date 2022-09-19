<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Company;
use App\Models\Country;
use App\Models\PaymentPlan;
use App\Models\State;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'subdomain' => fake()->domainName(),
            'status' => Company::STATUS_ACTIVE,
            'tax_id' => rand(),
            'email' => fake()->email(),
            'web_url' => fake()->url(),
            'phone' => fake()->phoneNumber(),
            'country_id' => Country::factory(),
            'city_id' => City::factory(),
            'state_id' => State::factory(),
            'address' => fake()->address(),
            'zip_code' => fake()->postcode(),
            'logo' => fake()->image(),
            'payment_plan_id' => PaymentPlan::factory(),
        ];
    }
}
