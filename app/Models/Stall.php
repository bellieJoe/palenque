<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stall extends Model
{
    //
    use SoftDeletes;
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
