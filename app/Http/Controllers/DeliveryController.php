<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use App\Models\DeliveryItem;
use App\Models\DeliveryTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

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

    public function apiStore(Request $request)
    {
        $request->validate([
            'delivery_date' => 'required',
            'supplier' => 'required|exists:suppliers,id',
            'items' => 'required|array',
            'items.*.item' => 'required|exists:items,id',
            'items.*.unit' => 'required|exists:units,id',
            'items.*.quantity' => 'required|numeric|min:1',
            'items.*.tax' => 'required|numeric|min:0',
            'items.*.ticket_no' => 'required',
            'items.*.ticket_status' => 'required|in:PAID,UNPAID,WAIVED',
            'items.*.total_sales' => 'required|numeric|min:0',
        ]);

        return DB::transaction(function () use ($request) {
            $delivery = Delivery::create([
                'delivery_date' => $request->delivery_date,
                'supplier_id' => $request->supplier,
                'municipal_market_id' => auth()->user()->marketDesignation()->id,
            ]);

            foreach ($request->items as $item) {
                $delivery_item = DeliveryItem::create([
                    'delivery_id' => $delivery->id,
                    'item_id' => $item['item'],
                    'unit_id' => $item['unit'],
                    'amount' => $item['quantity'],
                    'sales' => $item['total_sales'],
                ]);

                DeliveryTicket::create([
                    'delivery_item_id' => $delivery_item->id,
                    'municipal_market_id' => auth()->user()->marketDesignation()->id,
                    'amount' => $item['tax'],
                    'status' => $item['ticket_status'],
                    'date_issued' => $request->delivery_date,
                    'ticket_no' => $item['ticket_no'],
                ]);
            }
        });
    }
}
