<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fee extends Model
{
    //
    use SoftDeletes;
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

    public function generateNextTicketNo(){
        $latestFee = Fee::whereYear('date_issued', now()->year)->orderBy('no', 'desc')->first();
        $no = $latestFee ? $latestFee->no + 1 : 1;
        return $no;
    }

}
