<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VendorPrice extends Model
{
    //
    protected $guarded = [];
    public function vendor(){
        return $this->belongsTo(Vendor::class);
    }

    public function item(){
        return $this->belongsTo(Item::class);
    }
}
