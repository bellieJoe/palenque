<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vendor extends Model
{
    //
    use SoftDeletes;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function violations()
    {
        return $this->hasMany(Violation::class);
    }

    public function stallOccupants()
    {
        return $this->hasMany(StallOccupant::class);
    }

    public function getUnresolvedViolationsAttribute()
    {
        return $this->violations()->where('status', "PENDING");
    }

    public function getResolvedViolationsAttribute()
    {
        return $this->violations()->where('status', "RESOLVED");
    }

    public function getWaivedViolationsAttribute()
    {
        return $this->violations()->where('status', "WAIVED");
    }

    public function marketDesignation()
    {
        return MunicipalMarket::find($this->municipal_market_id);
    }

    public function appSettings()
    {
        return AppSettings::where('municipal_market_id', $this->municipal_market_id)->first();
    }
}
