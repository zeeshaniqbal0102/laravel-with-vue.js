<?php

namespace Database\Factories;

use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

class CountryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Country::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        /**
         ******************************* NOTE: *******************************
         * The data is fake only for dummy purpose, so the "country name" and "country code" might not be synced respected to each other.
         */
        return [
            'name' => $this->faker->country,
            'country_code' => $this->faker->countryCode,
        ];
    }
}

