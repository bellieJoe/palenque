<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DeliveryController extends Controller
{
    //
    public function apiIndex(Request $request)
    {
        $date = $request->date ? $request->date : date('Y-m-d');
        return Delivery::query()
        ->with('deliveryItems.item', 'deliveryItems.unit', 'deliveryItems.deliveryTicket', 'supplier')
        ->whereDate('delivery_date', Carbon::parse($date)->format('Y-m-d'))
        ->where('municipal_market_id', auth()->user()->marketDesignation()->id)
        ->get();
    }
}
