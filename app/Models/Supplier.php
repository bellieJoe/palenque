<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    //
    use SoftDeletes;
    protected $guarded = [];

    public function municipalMarker()
    {
        return $this->belongsTo(MunicipalMarket::class);
    }

    public function deliveries()
    {
        return $this->hasMany(Delivery::class);
    }

    public function origin()
    {
        return $this->belongsTo(Origin::class)->withTrashed();
    }
}
