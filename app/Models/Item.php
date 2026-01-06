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

    public function defaultUnit(){
        return $this->belongsTo(Unit::class);
    }

    public function getUnitsAttribute(){
        return Unit::whereHas("itemTaxRate", function ($q){
            return $q->where("item_id", $this->id);
        })->get();
    }

    public function getUpdatedPricesAttribute(){
        return $this->hasMany(PriceMonitoringRecord::class)
        ->orderBy('unit_id')
        ->orderByDesc('date')
        ->get()
        ->unique('unit_id')
        ->values();
    }
}
