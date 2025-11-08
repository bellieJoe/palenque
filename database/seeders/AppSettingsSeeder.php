<?php

namespace Database\Seeders;

use App\Models\AppSettings;
use App\Models\MunicipalMarket;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AppSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        MunicipalMarket::all()->each(function ($municipalMarket) {
            AppSettings::create([
                'municipal_market_id' => $municipalMarket->id,
            ]);
        });
    }
}
