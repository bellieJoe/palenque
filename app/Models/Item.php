<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    //
    protected $guarded = [];

    public function itemCategory(){
        return $this->belongsTo(ItemCategory::class);
    }
}
