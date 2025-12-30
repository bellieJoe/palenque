<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    //
    public function apiIndex()
    {
        return Unit::where('municipal_market_id', auth()->user()->marketDesignation()->id)->get();
    }
}
