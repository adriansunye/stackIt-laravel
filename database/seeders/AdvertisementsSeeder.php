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
            'name' => "Frontend Developer - Asturias",
            'category' => "FrontEnd",
        ]);
        
        Advertisement::factory()->create([
            'name' => "Backend Developer - Asturias",
            'category' => "Backend",
        ]);

        Advertisement::factory()->create([
            'name' => "FullStack Developer - Asturias",
            'category' => "FullStack",
        ]);

        Advertisement::factory()->create([
            'name' => "Systems Engenieer - Barcelona",
            'category' => "systems",
        ]);
        
        Advertisement::factory()->create([
            'name' => "Graphic Designer - Barcelona",
            'category' => "Graphic Design",
        ]);

        Advertisement::factory()->create([
            'name' => "Scrum Expert - Barcelona",
            'category' => "Agile Methologies",
        ]);

        Advertisement::factory()->create([
            'name' => "Cloud Engenieer - Madrid",
            'category' => "Cloud",
        ]);
        
        Advertisement::factory()->create([
            'name' => "Graphic Designer - Madrid",
            'category' => "Graphic Design",
        ]);

        Advertisement::factory()->create([
            'name' => "FullStack Developer - Bilbao",
            'category' => "FullStack",
        ]);

        Advertisement::factory()->create([
            'name' => "Frontend Developer Bilbao",
            'category' => "FrontEnd",
        ]);
        
        Advertisement::factory()->create([
            'name' => "Backend Developer - Girona",
            'category' => "Backend",
        ]);

        Advertisement::factory()->create([
            'name' => "FullStack Developer - Girona",
            'category' => "FullStack",
        ]);
    }
}
