<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryItem extends Model
{
    //
    protected $guarded = [];
    
    public function delivery()
    {
        return $this->belongsTo(Delivery::class, 'delivery_id');
    }

    public function deliveryItem()
    {
        return $this->belongsTo(Item::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function deliveryTicket()
    {
        return $this->hasOne(DeliveryTicket::class);
    }

    public function originated () {
        return $this->belongsTo(Origin::class, 'origin');
    }
}
