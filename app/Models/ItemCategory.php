<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemCategory extends Model
{
    //
    use SoftDeletes;
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
