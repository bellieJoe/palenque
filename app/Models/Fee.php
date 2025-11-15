<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    //
    protected $guarded = [];
    protected $casts = [
        "date_issued" => "date"
    ];

    public function stallOccupant()
    {
        return $this->belongsTo(StallOccupant::class, "owner_id", "id");
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, "owner_id", "id");
    }

    public function ambulantStall()
    {
        return $this->belongsTo(AmbulantStall::class, "owner_id", "id");
    }

}
