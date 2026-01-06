<?php

namespace Database\Seeders;

use App\Models\MunicipalMarket;
use App\Models\RolePreset;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolePresetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        MunicipalMarket::all()->each(function ($municipalMarket) {
            RolePreset::insert([
                [
                    "municipal_market_id" => $municipalMarket->id,
                    "role_type_id" => 2,
                ],
                [
                    "municipal_market_id" => $municipalMarket->id,
                    "role_type_id" => 3,
                ],
                [
                    "municipal_market_id" => $municipalMarket->id,
                    "role_type_id" => 4,
                ],
                [
                    "municipal_market_id" => $municipalMarket->id,
                    "role_type_id" => 5,
                ],
            ]);
        });
    }
}
