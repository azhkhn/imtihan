<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Company;
use App\Models\Country;
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

            'name' => $this->faker->name,
            'subdomain' => $this->faker->domainName,
            'is_active' => Company::STATUS_ACTIVE,
            'tax_id' => rand(11, 11),
            'email' => $this->faker->email,
            'web_url' => $this->faker->url,
            'phone' => $this->faker->phoneNumber,
            'logo' => $this->faker->imageUrl,
            'country_id' => Country::factory(),
            'city_id' => City::factory(),
            'state_id' => State::factory(),
            'address' => $this->faker->address,
            'zip_code' => $this->faker->postcode,
        ];
    }
}
