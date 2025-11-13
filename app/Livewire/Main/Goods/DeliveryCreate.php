<?php

namespace App\Livewire\Main\Goods;

use App\Models\Delivery;
use App\Models\DeliveryItem;
use App\Models\DeliveryTicket;
use App\Models\Item;
use App\Models\Supplier;
use App\Models\Unit;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Validate;
use Livewire\Component;

class DeliveryCreate extends Component
{
    public $suppliers;
    #[Validate('required|array')]
    public array $items = [];
    public $itemOptions;
    public $unitOptions;
    #[Validate('required|exists:suppliers,id')]
    public $supplier;
    #[Validate('required|date|before_or_equal:today')]
    public $date_delivered;

    public function addItem()
    {
        array_push($this->items, [
            'item_id' => null,
            'amount' => null,
            'unit_id' => null,
            'tax' => null,
            'ticket_no' => null,
            'ticket_status' => null,
            'receipt_no' => null
        ]);
    }

    public function updatingItems($value)
    {
        Log::info($this->items);
    }

    public function removeItem($key)
    {
        unset($this->items[$key]);
        // $this->items = array_values($this->items); // reindex
    }

    public function storeDelivery()
    {
        $validated = $this->validate([
            'supplier' => 'required|exists:suppliers,id',
            'date_delivered' => 'required|date|before_or_equal:today',
            'items.*.item_id' => 'required|exists:items,id',
            'items.*.amount' => 'required|numeric',
            'items.*.unit_id' => 'required|exists:units,id',
            'items.*.tax' => 'required|numeric',
            'items.*.ticket_no' => 'required',
            'items.*.ticket_status' => 'required|in:PAID,UNPAID,WAIVED',
            'items.*.receipt_no' => 'required_if:items.*.ticket_status,PAID',
        ], [
            
        ], [
            'items.*.item_id' => 'Item',
            'items.*.amount' => 'Amount',
            'items.*.unit_id' => 'Unit',
            'items.*.tax' => 'Tax',
            'items.*.ticket_no' => 'Ticket No.',
            'items.*.ticket_status' => 'Ticket Status',
            'items.*.receipt_no' => 'Receipt No.',
        ]);

        DB::transaction(function () {
            try {
                $delivery = Delivery::create([
                    'supplier_id' => $this->supplier,
                    'delivery_date' => $this->date_delivered,
                    'municipal_market_id' => auth()->user()->marketDesignation()->id,
                ]);

                $deliveryItemsData = [];
                $deliveryTicketsData = [];

                foreach ($this->items as $item) {
                    $deliveryItemsData[] = [
                        'delivery_id' => $delivery->id,
                        'item_id' => $item['item_id'],
                        'amount' => $item['amount'],
                        'unit_id' => $item['unit_id'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }

                $insertedItems = DeliveryItem::insert($deliveryItemsData);
                $deliveryItems = DeliveryItem::where('delivery_id', $delivery->id)->get();
                foreach ($deliveryItems as $index => $deliveryItem) {
                    $item = $this->items[$index];

                    $deliveryTicketsData[] = [
                        'delivery_item_id' => $deliveryItem->id,
                        'municipal_market_id' => auth()->user()->marketDesignation()->id,
                        'amount' => $item['tax'] ?? 0,
                        'ticket_no' => $item['ticket_no'] ?? null,
                        'status' => $item['ticket_status'] ?? 'UNPAID',
                        'receipt_no' => $item['receipt_no'] ?? null,
                        'date_issued' => now(),
                        'date_paid' => isset($item['ticket_status']) && $item['ticket_status'] === 'PAID'
                            ? now()
                            : null,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }

                // 4️⃣ Insert all tickets at once
                DeliveryTicket::insert($deliveryTicketsData);
                notyf()->position('y', 'top')->success('Delivery saved successfully!');
                $this->redirectRoute('main.deliveries.index', navigate: true);
            } catch (\Throwable $th) {
                DB::rollBack();
                Log::error($th);
                notyf()->position('y', 'top')->error('Something went wrong while saving the delivery!');
            }
        });
    }

    public function mount()
    {
        $this->suppliers = Supplier::where('municipal_market_id', auth()->user()->marketDesignation()->id)->get();
        $this->itemOptions = Item::where('municipal_market_id', auth()->user()->marketDesignation()->id)->get();
        $this->unitOptions = Unit::where('municipal_market_id', auth()->user()->marketDesignation()->id)->get();
    }

    public function render()
    {
        return view('livewire.main.goods.delivery-create');
    }
}
