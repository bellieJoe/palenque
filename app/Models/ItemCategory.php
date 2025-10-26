<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemCategory extends Model
{
    //
    protected $guarded = [];
    
    public function municipalMarket()
    {
        return $this->belongsTo(MunicipalMarket::class);
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
