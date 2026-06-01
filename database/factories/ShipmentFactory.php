<?php

namespace Database\Factories;

use App\Models\Truck;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shipment>
 */
class ShipmentFactory extends Factory
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
            'delivery_order_price' => fake()->numberBetween(1000000, 10000000),
            'client' => fake()->company(),
            'load_type' => fake()->randomElement(['retail', 'electronics', 'furniture', 'machines', 'foods']),
            'departure_waybill_number' => fake()->numerify('TUC-####-####'),
            'return_waybill_number' => fake()->numerify('RET-####-####'),
            'departure_latitude' => fake()->latitude(),
            'departure_longitude' => fake()->longitude(),
            'departure_location' => fake()->address(),
            'status' => fake()->randomElement(['perjalanan', 'selesai'])
        ];
    }   
}