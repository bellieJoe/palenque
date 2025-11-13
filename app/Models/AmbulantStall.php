<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AmbulantStall extends Model
{
    //
    protected $guarded = [];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function municipalMarket()
    {
        return $this->belongsTo(MunicipalMarket::class);
    }
}
