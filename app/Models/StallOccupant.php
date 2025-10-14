<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StallOccupant extends Model
{
    //
    protected $guarded = [];

    public function stall()
    {
        return $this->belongsTo(Stall::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}
