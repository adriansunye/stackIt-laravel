<?php

namespace Database\Seeders;

use App\Models\Advertisement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdvertisementsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Advertisement::factory()->create([
            'name' => "Frontend Developer",
            'category' => "frontEnd",
        ]);
        
        Advertisement::factory()->create([
            'name' => "Backend Developer",
            'category' => "backend",
        ]);

        Advertisement::factory()->create([
            'name' => "FullStack Developer",
            'category' => "fullStack",
        ]);
    }
}
