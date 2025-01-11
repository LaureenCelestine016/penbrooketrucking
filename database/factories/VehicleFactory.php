<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
    protected $model = \App\Models\Vehicle::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     public function definition()
     {
         return [
            'name'                       => $this->faker->word(), // Use a generic word as a placeholder for the vehicle name
            'type'                       => $this->faker->randomElement(['Sedan', 'SUV', 'Truck', 'Hatchback']),
            'model'                      => $this->faker->bothify('Model-####'),
            'chassis_number'             => $this->faker->unique()->regexify('[A-Z0-9]{17}'),
            'engine_number'              => $this->faker->unique()->regexify('[A-Z0-9]{10}'),
            'manufacturer'               => $this->faker->company(),
            'registration_number'        => $this->faker->unique()->regexify('[A-Z]{2}[0-9]{4}[A-Z]{2}'),
            'registration_date'          => $this->faker->dateTimeBetween('now', '+5 years'),
            'registration_expiration_date' => $this->faker->dateTimeBetween('now', '+5 years'),
            'license_plate'              => $this->faker->unique()->regexify('[A-Z0-9]{7}'),
            'manufacture_year'           => $this->faker->year(),
            'status'                     => $this->faker->randomElement(['active', 'inactive', 'maintenance']),
            'image'                      => $this->faker->image('public/storage/images', 640, 480, null, false),
            'created_at'                 => now(),
            'updated_at'                 => now(),
         ];
     }
}
