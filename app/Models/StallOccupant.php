<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StallOccupant extends Model
{
    //
    use SoftDeletes;
    protected $guarded = [];

    public function stall()
    {
        return $this->belongsTo(Stall::class)->withTrashed();
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function stallContracts()
    {
        return $this->hasMany(StallContract::class);
    }

    public function stallContract(){
        return $this->hasOne(StallContract::class);
    }

    public function violations()
    {
        return $this->hasMany(Violation::class);
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



    public function getActiveContractAttribute()
    {
        return $this->stallContracts()->where('to', '>=', now())->where('status', 'ACTIVE')->first();
    }
}
