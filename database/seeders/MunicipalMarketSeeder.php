<?php

namespace Database\Seeders;

use App\Models\MunicipalMarket;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MunicipalMarketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        MunicipalMarket::insert([
            [
                "id" => 1,
                "name" => "Boac Municipal Market",
                "address" => "Boac, Marinduque"
            ],
            [
                "id" => 2,
                "name" => "Mogpog Municipal Market",
                "address" => "Mogpog, Marinduque"
            ],
            [
                "id" => 3,
                "name" => "Sta. Cruz Municipal Market",
                "address" => "Sta. Cruz, Marinduque"
            ],
            [
                "id" => 4,
                "name" => "Buenavista Municipal Market",
                "address" => "Buenavista, Marinduque"
            ],
            [
                "id" => 5,
                "name" => "Torrijos Municipal Market",
                "address" => "Torrijos, Marinduque"
            ],
            [
                "id" => 6,
                "name" => "Gasan Municipal Market",
                "address" => "Gasan, Marinduque"
            ],
        ]);
    }
}
