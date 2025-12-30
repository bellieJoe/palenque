<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    //
    public function apiIndex()
    {
        return Supplier::where("municipal_market_id", auth()->user()->marketDesignation()->id)->get();
    }
}
