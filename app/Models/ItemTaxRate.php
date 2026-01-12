<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemTaxRate extends Model
{
    //
    use SoftDeletes;
    protected $table = 'item_tax_rates';
    protected $guarded = [];

    public function unit(){
        return $this->belongsTo(Unit::class);
    }

    public function item(){
        return $this->belongsTo(Item::class);
    }
}
