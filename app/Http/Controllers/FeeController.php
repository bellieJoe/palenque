<?php

namespace App\Http\Controllers;

use App\Models\Fee;
use Illuminate\Http\Request;

class FeeController extends Controller
{
    //
    public function apiIndex(Request $request)
    {
        $date = $request->date ? $request->date : date('Y-m-d');
        $month = date('m', strtotime($date));
        $year = date('Y', strtotime($date));

        return Fee::query()
        ->with('ambulantStall.vendor')
        ->where('fee_type', 'STALL')
        ->where('municipal_market_id', auth()->user()->marketDesignation()->id)
        ->whereYear("date_issued", $year)
        ->whereMonth("date_issued", $month)
        ->get();
    }

    public function apiCreateAmbulantStallFee(Request $request)
    {
        $request->validate([
            'ambulant_stall' => 'required|exists:ambulant_stalls,id',
            'amount' => 'required',
            'date_paid' => 'required_if:status,PAID',
            'receipt_no' => 'required_if:status,PAID',
            'status' => 'required|in:PAID,UNPAID',
            'remarks' => 'nullable|max:255',
        ]);

        $latestFee = Fee::whereYear('date_issued', now()->year)->orderBy('no', 'desc')->first();
        $ticketNo = $latestFee ? str_pad($latestFee->no + 1, 6, '0', STR_PAD_LEFT) : str_pad(1, 6, '0', STR_PAD_LEFT);
        $fee = Fee::create([
           'ticket_no' => $ticketNo,
           'no' => $latestFee ? $latestFee->no + 1 : 1,
           'owner_id' => $request->ambulant_stall,
           'municipal_market_id' => auth()->user()->marketDesignation()->id,
           'fee_type' => 'STALL',
           'amount' => $request->amount,
           'remarks' => $request->remarks,
           'date_paid' => $request->status == 'PAID' ? $request->date_paid : null,
           'receipt_no' => $request->status == 'PAID' ? $request->receipt_no : null,
           'status' => $request->status,
           'date_issued' => now()
        ]);
    }

    public function apiUpdateAmbulantStallFee(Request $request, $id){
        $request->validate([
            'date_paid' => 'required_if:status,PAID',
            'receipt_no' => 'required_if:status,PAID',
            'remarks' => 'nullable|max:255',
        ]);

        Fee::find($id)->update([
            'date_paid' => $request->date_paid,
            'receipt_no' =>  $request->receipt_no,
            'status' => 'PAID',
            'remarks' => $request->remarks
        ]);
    }


}
