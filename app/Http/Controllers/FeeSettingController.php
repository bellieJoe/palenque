<?php

namespace App\Http\Controllers;

use App\Models\FeeSetting;
use App\Models\ItemFeeSetting;
use Illuminate\Http\Request;

class FeeSettingController extends Controller
{
    //
    public function apiGetActive(){
        return FeeSetting::query()->where('is_active', true)->where('municipal_market_id', auth()->user()->marketDesignation()->id)->first();
    }
}
