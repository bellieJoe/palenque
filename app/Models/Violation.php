<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Violation extends Model
{
    //
    use SoftDeletes;
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
