<?php

namespace App\Http\Controllers;

use App\Models\AmbulantStall;
use Illuminate\Http\Request;

class AmbulantStallController extends Controller
{
    //
    public function apiIndex(Request $request)
    {
        return AmbulantStall::query()
        ->with('vendor')
        ->where('municipal_market_id', auth()->user()->marketDesignation()->id)
        ->get();
    }
}
