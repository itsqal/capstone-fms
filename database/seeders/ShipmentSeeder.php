<?php

namespace Database\Seeders;

use App\Models\Shipment;
use App\Models\Truck;
use Illuminate\Database\Seeder;

class ShipmentSeeder extends Seeder
{
    /**
     * Seed the shipments table.
     * Requires: Users and Trucks must exist first
     */
    public function run(): void
    {
        $trucks = Truck::all();

        if ($trucks->isEmpty()) {
            $this->command->warn('❌ No trucks found. Please seed trucks first.');
            return;
        }

        // Create 30 shipments with user_id=22 and random existing truck_id
        Shipment::factory(30)
            ->sequence(function ($sequence) use ($trucks) {
                return [
                    'truck_id' => $trucks->random()->id,
                ];
            })
            ->create();

        $this->command->info('✅ 30 shipments created successfully with user_id=22.');
    }
}
