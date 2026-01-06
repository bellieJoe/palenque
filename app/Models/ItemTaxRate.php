<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemTaxRate extends Model
{
    //
    protected $table = 'item_tax_rates';
    protected $guarded = [];

    public function unit(){
        return $this->belongsTo(Unit::class);
    }

    public function item(){
        return $this->belongsTo(Item::class);
    }
}
