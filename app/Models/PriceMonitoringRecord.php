<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PriceMonitoringRecord extends Model
{
    protected $guarded = [];
    //
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
