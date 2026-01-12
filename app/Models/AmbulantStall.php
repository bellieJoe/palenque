<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AmbulantStall extends Model
{
    //
    use SoftDeletes;
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
