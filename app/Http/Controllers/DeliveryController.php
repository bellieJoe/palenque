<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    //
    public function apiIndex()
    {
        return Delivery::query()
        ->where('municipal_market_id', auth()->user()->marketDesignation()->id)
        ->get();
    }
}
