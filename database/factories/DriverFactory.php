<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Driver>
 */
class DriverFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName,
            'middle_name' => $this->faker->lastName,
            'last_name' => $this->faker->lastName,
            'civil_status' => $this->faker->randomElement(['Single', 'Married', 'Divorced', 'Widowed']),
            'birthday' => $this->faker->dateTimeBetween('-60 years', '-20 years')->format('Y-m-d'),
            'address' => $this->faker->address,
            'contact_number' => $this->faker->unique()->phoneNumber,
            'contact_person' =>$this->faker->name,
            'contact_#_person' => $this->faker->unique()->phoneNumber,
            'relation' => $this->faker->randomElement(['Spouse','Father','Mother','Children','Sibling','Other']),
            'age' => $this->faker->numberBetween(20, 60),
            'image' => $this->faker->imageUrl(640, 480, 'people'),
            'pagibig_no' => $this->faker->optional()->regexify('[0-9]{12}'), // Generates a 12-digit string
            'philhealth_no' => $this->faker->optional()->regexify('[0-9]{12}'), // Generates a 12-digit string
            'sss_no' => $this->faker->optional()->regexify('[0-9]{10}'), // Generates a 10-digit string
            'tin_no' => $this->faker->optional()->regexify('[0-9]{9}'), // Generates a 9-digit string
            'license_number' => $this->faker->unique()->regexify('[A-Z0-9]{10}'),
            'license_expired' => $this->faker->dateTimeBetween('now', '+5 years')->format('Y-m-d'),
            'status' => $this->faker->randomElement(['Active', 'Inactive']),
        ];
    }
}
