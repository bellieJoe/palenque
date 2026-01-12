<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    //
    use SoftDeletes;
    protected $guarded = [];

    public function roleType()
    {
        return $this->belongsTo(RoleType::class);
    }

    public function municipalMarket()
    {
        return $this->belongsTo(MunicipalMarket::class);
    }
}
