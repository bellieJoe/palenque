<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StallContract extends Model
{
    //
    use SoftDeletes;
    protected $guarded = [];
    protected $casts = [
        'from' => 'date',
        'to' => 'date',
    ];

    public function rate()
    {
        return $this->belongsTo(StallRate::class, 'stall_rate_id', 'id');
    }

    public function stallOccupant()
    {
        return $this->belongsTo(StallOccupant::class);
    }

    public function stall()
    {
        return $this->belongsTo(Stall::class);  
    }

    public function monthlyRents()
    {
        return $this->hasMany(MonthlyRent::class);
    }
}
