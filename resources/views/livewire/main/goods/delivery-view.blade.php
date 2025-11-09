<div>
    @livewire('main.goods.update-delivery-ticket-payment')
    <x-page-header title="Wet & Dry Goods Deliveries" />
    <div class="card">
        <div class="card-header">
            <h6 class="card-title"><a class="btn btn-sm btn-outline-secondary border-0" href="{{ route('main.deliveries.index') }}" wire:navigate><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a> Delivery Details</h6>
        </div>
        <div class="card-body">
            {{-- <h5 class="font-weight-bold">Basic Information</h5> --}}
            <div class="row">
                <div class="col-lg-4 mb-2">
                    <label class="small mb-0 text-muted">Supplier</label>
                    <div>{{ $delivery->supplier->name }}</div>
                </div>
                <div class="col-lg-4 mb-2">
                    <label class="small mb-0 text-muted">Delivery Date</label>
                    <div>{{ $delivery->delivery_date->format('F d, Y') }}</div>
                </div>
            </div>

            <hr>
            <div class="d-flex justify-content-between">
                <h5 class="font-weight-bold">Delivered Items</h5>
            </div>
            <br>
            <div class="table-responsive">
                <table class="table table-hover" style="min-width: 1200px;">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Quantity</th>
                            <th>Tax</th>
                            <th>Ticket No.</th>
                            <th>Receipt No.</th>
                            <th>Date Issued</th>
                            <th>Ticket Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($delivery->deliveryItems as $deliveryItem)
                            <tr>
                                <td>{{ $deliveryItem->item->name }}</td>
                                <td>{{ $deliveryItem->amount }} {{ $deliveryItem->unit->name }}</td>
                                <td>Php {{ number_format($deliveryItem->deliveryTicket->amount, 2, '.', ',') }}</td>
                                <td>{{ $deliveryItem->deliveryTicket->ticket_no }}</td>
                                <td>{{ $deliveryItem->deliveryTicket->receipt_no ? $deliveryItem->deliveryTicket->receipt_no : 'N/A' }}</td>
                                <td>{{ $deliveryItem->deliveryTicket->date_issued->format('F d, Y') }}</td>
                                <td><span class="badge badge-{{ $deliveryItem->deliveryTicket->status == 'PAID' ? 'success' : ($deliveryItem->deliveryTicket->status == 'UNPAID' ? 'warning' : 'secondary') }}">{{ $deliveryItem->deliveryTicket->status }}</span></td>
                                <td>    
                                    @if ($deliveryItem->deliveryTicket->status === 'UNPAID')
                                        <button class="btn btn-outline-primary"  wire:click="waiveTicket({{$deliveryItem->deliveryTicket->id}})" wire:confirm="Are you sure you want to waive this ticket?">Waive</button>
                                        <button class="btn btn-outline-primary"  wire:click="updateDeliveryTicketPayment({{$deliveryItem->deliveryTicket->id}})" >Update Payment</button>
                                    @endif
                                    {{-- <button class="btn btn-outline-danger" wire:click="deleteStall({{$stall->id}})" wire:confirm="Are you sure you want to remove this stall?">Remove</button> --}}
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="8" class="text-center">No Stalls Found</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
