<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeliveryTicket extends Model
{
    //
    use SoftDeletes;
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
