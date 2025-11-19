<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Violation extends Model
{
    //
    protected $guarded = [];
    protected $dates = ['created_at', 'updated_at'];

    public function violationType()
    {
        return $this->belongsTo(ViolationType::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function stallOccupant()
    {
        return $this->belongsTo(StallOccupant::class);
    }
}
