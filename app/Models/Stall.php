<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stall extends Model
{
    //
    protected $guarded = [];

    public function municipalMarket()
    {
        return $this->belongsTo(MunicipalMarket::class);
    }
}
