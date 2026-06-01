<?php

namespace Database\Seeders;

use App\Models\Report;
use App\Models\Truck;
use Illuminate\Database\Seeder;

class ReportSeeder extends Seeder
{
    /**
     * Seed the reports table.
     * Requires: Users and Trucks must exist first
     */
    public function run(): void
    {
        $trucks = Truck::all();

        if ($trucks->isEmpty()) {
            $this->command->warn('❌ No trucks found. Please seed trucks first.');
            return;
        }

        // Create 50 reports with user_id=22 and random existing truck_id
        Report::factory(50)
            ->sequence(function ($sequence) use ($trucks) {
                return [
                    'truck_id' => $trucks->random()->id,
                ];
            })
            ->create();

        $this->command->info('✅ 50 reports created successfully with user_id=22.');
    }
}
