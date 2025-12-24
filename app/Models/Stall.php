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

    public function stallOccupants()
    {
        return $this->hasMany(StallOccupant::class);
    }

    public function stallRate()
    {
        return $this->belongsTo(StallRate::class);
    }

    public function getActiveOccupantAttribute()
    {
        return $this->stallOccupants()->where('status', true)->first();
    }
}
