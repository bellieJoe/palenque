<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonthlyRent extends Model
{
    //
    protected $table = 'monthly_rents';
    protected $guarded = [];
    protected $casts = [
        'due_date' => 'datetime',
        'payment_date' => 'datetime',
        'bill_date' => 'datetime'
    ];
    
    public function stallContract()
    {
        return $this->belongsTo(StallContract::class);
    }

    public function getPenaltyAttribute()
    {
        $appSettings = auth()->user()->appSettings();
        if(now()->lt($this->due_date)) {
            return 0;
        }
        $penalty = 0;
        $days = $this->due_date->diffInDays(now());
        $penalty = ($days / $appSettings->rent_surcharge_frequency ) * ($appSettings->rent_surcharge_rate / 100) * $this->amount;
        return $penalty;
    }
}
