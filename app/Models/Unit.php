<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    //
    protected $guarded = [];

    public function itemTaxRate(){
        return $this->hasMany(ItemTaxRate::class);
    }

    public function baseUnit(){
        return $this->hasOne(Unit::class, 'id', 'base_unit_id');
    }
}
