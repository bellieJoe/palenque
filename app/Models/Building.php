<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Building extends Model
{
    use SoftDeletes;
    //
    protected $table = 'buildings';
    protected $guarded = [];    

    public function stalls()
    {
        return $this->hasMany(Stall::class);
    }
}
