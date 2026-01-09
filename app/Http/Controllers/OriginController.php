<?php

namespace App\Http\Controllers;

use App\Models\Origin;
use Illuminate\Http\Request;

class OriginController extends Controller
{
    //
    public function apiIndex(){
        return Origin::all();
    }
}
