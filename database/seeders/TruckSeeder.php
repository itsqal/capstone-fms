<?php

namespace Database\Seeders;

use App\Models\Truck;
use App\Models\User;
use Illuminate\Database\Seeder;

class TruckSeeder extends Seeder
{
    /**
     * Seed the trucks table.
     * Can be run individually: php artisan db:seed --class=TruckSeeder
     * Requires: Users must exist first
     */
    public function run(): void
    {
        $users = User::all();
        
        if ($users->isEmpty()) {
            $this->command->warn('❌ No users found. Please seed users first: php artisan db:seed --class=DatabaseSeeder');
            return;
        }

        // Create 15 trucks using TruckFactory
        Truck::factory(15)
            ->sequence(function ($sequence) use ($users) {
                return [
                    'user_id' => 22,
                ];
            })
            ->create();

        $this->command->info('✅ 15 trucks created successfully.');
    }
}
