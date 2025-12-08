<?php

namespace App\Http\Controllers;

use App\Models\StallOccupant;
use Illuminate\Http\Request;

class StallOccupantController extends Controller
{
    //
    public function apiIndex(Request $request) {
        return StallOccupant::query()
        ->with('vendor', 'stall')
        ->whereHas('stall', function ($query) {
            $query->where('municipal_market_id', auth()->user()->marketDesignation()->id);
        })
        ->get();
    }
}
