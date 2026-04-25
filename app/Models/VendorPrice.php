<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VendorPrice extends Model
{
    //
    protected $guarded = [];

    protected $casts = [
        'price' => 'float',
        'date' => 'date'
    ];
    
    public function vendor(){
        return $this->belongsTo(Vendor::class);
    }

    public function item(){
        return $this->belongsTo(Item::class);
    }
}
