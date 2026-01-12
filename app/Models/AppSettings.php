<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AppSettings extends Model
{
    //
    use SoftDeletes;
    
    protected $table = 'app_settings';
    protected $guarded = [];
}
