<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project; // pastikan model Project ada

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Project::create([
            'name' => 'Website E-Commerce',
            'description' => 'Project toko online untuk client'
        ]);

        Project::create([
            'name' => 'Aplikasi Mobile',
            'description' => 'Project aplikasi Android/iOS'
        ]);

        Project::create([
            'name' => 'Sistem Ticketing',
            'description' => 'Project internal ticket support'
        ]);
        Project::create([
            'name' => 'Project Integrasi & Automasi',
            'description' => 'Project internal ticket support'
        ]);
    }
}
