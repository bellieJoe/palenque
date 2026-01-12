<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    //
    protected $table = 'buildings';
    protected $guarded = [];

    public function stalls()
    {
        return $this->hasMany(Stall::class);
    }
}
