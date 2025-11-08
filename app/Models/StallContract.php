<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StallContract extends Model
{
    //
    protected $guarded = [];
    
    public function rate()
    {
        return $this->belongsTo(StallRate::class, 'stall_rate_id', 'id');
    }
}
