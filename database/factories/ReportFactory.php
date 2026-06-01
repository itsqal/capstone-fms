<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Report>
 */
class ReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 22,
            'truck_id' => 1, // will be overridden in seeder with random existing truck
            'plate_number' => strtoupper(fake()->bothify('B #### ??')),
            'report_location' => fake()->address(),
            'problem_type' => fake()->randomElement(['kemacetan', 'kecelakaan', 'masalah kendaraan', 'lainnya']),
            'problem_description' => fake()->paragraph(1)
        ];
    }
}
