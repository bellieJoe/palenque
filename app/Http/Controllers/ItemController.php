<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ItemController extends Controller
{
    //
    public function apiIndex(Request $request)
    {
        Log::info($request->type);
        return Item::query()
        ->with('defaultUnit', 'itemCategory', 'itemTaxRates.unit')
        ->where("municipal_market_id", auth()->user()->marketDesignation()->id)
        ->whereIn('type', $request->type ? [$request->type]: ['WET', 'DRY'])
        ->get();
    }
}
