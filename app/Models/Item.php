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

    public function priceMonitoringRecords(){
        return $this->hasMany(PriceMonitoringRecord::class);
    }

    public function getUpdatedPricesAttribute(){
        return PriceMonitoringRecord::where('item_id', $this->id)
        ->distinct(['unit_id', 'item_id'])
        ->latest()->get();
    }
}
