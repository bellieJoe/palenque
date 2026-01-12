<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PriceMonitoringRecord extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    protected $casts = [
        "date" => "date"
    ];
    
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
