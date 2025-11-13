<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryTicket extends Model
{
    //
    protected $guarded = [];
    protected $casts = [
        'date_issued' => 'datetime',
        'date_paid' => 'datetime',
    ];

    public function deliveryItem()
    {
        return $this->belongsTo(DeliveryItem::class);
    }
}
