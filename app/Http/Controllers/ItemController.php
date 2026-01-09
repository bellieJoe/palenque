<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    //
    public function apiIndex()
    {
        return Item::query()
        ->with('defaultUnit', 'itemCategory', 'itemTaxRates.unit')
        ->where("municipal_market_id", auth()->user()->marketDesignation()->id)
        ->get();
    }
}
