<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Delivery extends Model
{
    //
    use SoftDeletes;
    protected $guarded = [];
    protected $casts = [
        "delivery_date" => "date"
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function deliveryItems()
    {
        return $this->hasMany(DeliveryItem::class);
    }

    public function getPaidTicketsCountAttribute()
    {
        return DeliveryTicket::whereHas("deliveryItem", function ($q){
            return $q->whereHas("delivery", function ($q){
                return $q->where("id", $this->id);
            });
        })
        ->where("status", "PAID")
        ->count();
    }

    public function getTotalTicketsCountAttribute()
    {
        return DeliveryTicket::whereHas("deliveryItem", function ($q){
            return $q->whereHas("delivery", function ($q){
                return $q->where("id", $this->id);
            });
        })
        ->count();
    }

    public function getUnpaidTicketsCountAttribute()
    {
        return DeliveryTicket::whereHas("deliveryItem", function ($q){
            return $q->whereHas("delivery", function ($q){
                return $q->where("id", $this->id);
            });
        })
        ->where("status", "UNPAID")
        ->count();
    }

    public function getWaivedTicketsCountAttribute()
    {
        return DeliveryTicket::whereHas("deliveryItem", function ($q){
            return $q->whereHas("delivery", function ($q){
                return $q->where("id", $this->id);
            });
        })
        ->where("status", "WAIVED")
        ->count();
    }
}
