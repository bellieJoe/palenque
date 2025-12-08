<?php

namespace App\Http\Controllers;

use App\Models\MonthlyRent;
use Illuminate\Http\Request;

class MonthlyRentController extends Controller
{
    //
    public function apiIndex(Request $request)
    {
        $date = $request->date ? $request->date : date('Y-m-d');
        $month = date('m', strtotime($date));
        $year = date('Y', strtotime($date));

        return MonthlyRent::query()
        ->with('stallContract.stallOccupant.vendor', 'stallContract.stallOccupant.stall')
        ->where('municipal_market_id', auth()->user()->marketDesignation()->id)
        ->where('status', 'PAID')
        ->whereMonth('due_date', $month)
        ->whereYear('due_date', $year)
        ->get();
    }

    public function apiUnpaid(Request $request){
        $date = $request->date;
        $month = date('m', strtotime($date));
        $year = date('Y', strtotime($date));

        return MonthlyRent::query()
        ->with('stallContract.stallOccupant.vendor', 'stallContract.stallOccupant.stall')
        ->where('municipal_market_id', auth()->user()->marketDesignation()->id)
        ->where('status', 'UNPAID')
        ->whereMonth('due_date', $month)
        ->whereYear('due_date', $year)
        ->get();
    }

    public function updateRent(Request $request, $id) {
        $status = $request->status;
        $monthlyRent = MonthlyRent::find($id);
        $monthlyRent->status = $status;
        $monthlyRent->amount_paid = $status == 'PAID' ? ($monthlyRent->amount + $monthlyRent->penalty) : 0;
        $monthlyRent->save();

        return [
            'status' => 'success'
        ];
    }
}
