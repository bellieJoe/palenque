<?php

namespace App\Livewire\Stall\Vendor\Fee;

use App\Models\Fee;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class FeeIndex extends Component
{
    use WithPagination, WithoutUrlPagination;
    
    protected $listeners = [
        "refresh-fees"
    ];
    public $search;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function waive($id)
    {
        $fee = Fee::find($id);
        $fee->update([
            "status" => "WAIVED"
        ]);
        notyf()->position('y', 'top')->success('Ticket waived successfully!');
    }

    private function auth()
    {
        return base64_encode(env('PAYMONGO_SECRET_KEY') . ":");
    }

    public function payOnline($id, $type)
    {
        try {
            $fee = Fee::findOrFail($id);

            // ----------------------------------------
            // 1. CREATE PAYMENT INTENT ONLY IF NONE
            // ----------------------------------------
            if (!$fee->payment_json) {
                $amount = $fee->amount * 100;

                $intentResponse = Http::withHeaders([
                    'Authorization' => "Basic " . $this->auth(),
                    'Content-Type' => 'application/json',
                ])->post('https://api.paymongo.com/v1/payment_intents', [
                    'data' => [
                        'attributes' => [
                            'amount' => $amount,
                            'payment_method_allowed' => ['gcash', 'paymaya', 'card', 'qrph'],
                            'currency' => 'PHP'
                        ]
                    ]
                ]);

                if ($intentResponse->failed()) {
                    notyf()->error("Failed to create payment intent.");
                    Log::error("PayMongo Intent Error", $intentResponse->json());
                    return;
                }

                // Save JSON string
                $fee->update([
                    'payment_json' => json_encode($intentResponse->json())
                ]);
            }

            // Decode stored intent
            $intent = json_decode($fee->payment_json);
            $payment_intent_id = $intent->data->id;

            // ----------------------------------------
            // 2. CREATE PAYMENT METHOD
            // ----------------------------------------
            $methodResponse = Http::withHeaders([
                'Authorization' => "Basic " . $this->auth(),
                'Content-Type' => 'application/json',
            ])->post('https://api.paymongo.com/v1/payment_methods', [
                'data' => [
                    'attributes' => [
                        'type' => $type,
                        'billing' => [
                            'name' => $fee->ambulantStall->vendor->name,
                            'email' => $fee->ambulantStall->vendor->user->email
                        ]
                    ]
                ]
            ]);

            if ($methodResponse->failed()) {
                notyf()->error("Failed to create payment method.");
                Log::error("PayMongo Method Error", $methodResponse->json());
                return;
            }

            $method = $methodResponse->json()['data']['id'];

            // ----------------------------------------
            // 3. ATTACH PAYMENT METHOD TO INTENT
            // ----------------------------------------
            $attachResponse = Http::withHeaders([
                'Authorization' => "Basic " . $this->auth(),
                'Content-Type' => 'application/json',
            ])->post("https://api.paymongo.com/v1/payment_intents/{$payment_intent_id}/attach", [
                'data' => [
                    'attributes' => [
                        'payment_method' => $method,
                        'return_url' => route('payments.check-daily-collection-payment', $fee->id)
                    ]
                ]
            ]);

            if ($attachResponse->failed()) {
                notyf()->error("Failed to attach payment method.");
                Log::error("PayMongo Attach Error", $attachResponse->json());
                return;
            }

            // ----------------------------------------
            // 4. REDIRECT USER TO PAYMONGO CHECKOUT
            // ----------------------------------------
            $redirectUrl = $attachResponse->json()['data']['attributes']['next_action']['redirect']['url'];

            return redirect()->away($redirectUrl);

        } catch (\Exception $e) {
            // ----------------------------------------
            // GLOBAL ERROR CATCHER (unexpected errors)
            // ----------------------------------------
            notyf()->error("Something went wrong while processing payment.");
            Log::error("PayOnline Error: " . $e->getMessage());
            return;
        }
    }
    
    public function render()
    {
        $fees = Fee::query()
            ->whereHas("ambulantStall.vendor", fn($v) =>
                $v->where("name", "like", "%{$this->search}%")->where('id', auth()->user()->vendor->id)
            )
            ->where('fee_type', "stall")
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->whereHas("stallOccupant.vendor", fn($v) =>
                        $v->where("name", "like", "%{$this->search}%")
                    )
                    ->orWhereHas("supplier", fn($s) =>
                        $s->where("name", "like", "%{$this->search}%")
                    );
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        return view('livewire.stall.vendor.fee.fee-index', [
            'fees' => $fees
        ]);
    }
}
