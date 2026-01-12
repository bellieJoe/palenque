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
        return $this->belongsTo(Stall::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function stallContracts()
    {
        return $this->hasMany(StallContract::class);
    }



    public function getActiveContractAttribute()
    {
        return $this->stallContracts()->where('to', '>=', now())->where('status', 'ACTIVE')->first();
    }
}
