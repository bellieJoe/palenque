<?php

namespace Database\Seeders;

use App\Models\RoleType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        RoleType::insert([
            [
                "name" => "System Administrator",
                "id" => 1
            ],
            [
                "name" => "Market Supervisor",
                "id" => 2
            ],
            [
                "name" => "Market Inspector",
                "id" => 3
            ],
            [
                "name" => "Admin Aide",
                "id" => 4
            ],
            [
                "name" => "Market Specialist(Collector)",
                "id" => 5
            ],
        ]);
    }
}
