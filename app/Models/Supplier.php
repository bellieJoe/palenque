<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    //
    protected $guarded = [];

    public function municipalMarker()
    {
        return $this->belongsTo(MunicipalMarket::class);
    }
}
