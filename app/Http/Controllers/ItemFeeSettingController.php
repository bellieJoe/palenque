<?php

namespace App\Http\Controllers;

use App\Models\ItemFeeSetting;
use Illuminate\Http\Request;

class ItemFeeSettingController extends Controller
{
    //
    public function getActive()
    {
        return ItemFeeSetting::where("is_active", true)->where("municipal_market_id", auth()->user()->marketDesignation()->id)->first();
    }
}
