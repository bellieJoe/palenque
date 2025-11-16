<?php

namespace App\Livewire\Vendor\Fee;

use App\Models\MonthlyRent;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class MonthlyRentIndex extends Component
{
    use WithPagination, WithoutUrlPagination;

    private function auth()
    {
        return base64_encode(auth()->user()->vendor->appSettings()->paymongo_secret_key . ":");
    }

    public function payOnline($id, $type)
    {
        if(auth()->user()->vendor->appSettings()->enable_online_payment == false) {
            notyf()->position('y', 'top')->error('Online payment is not enabled.');
            return;
        }
        try {
            $monthlyRent = MonthlyRent::findOrFail($id);

            // ----------------------------------------
            // 1. CREATE PAYMENT INTENT ONLY IF NONE
            // ----------------------------------------
            if (!$monthlyRent->payment_json) {
                $amount = ($monthlyRent->amount + $monthlyRent->penalty) * 100;

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
                $monthlyRent->update([
                    'payment_json' => json_encode($intentResponse->json())
                ]);
            }

            // Decode stored intent
            $intent = json_decode($monthlyRent->payment_json);
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
                            'name' => $monthlyRent->stallContract->stallOccupant->vendor->name,
                            'email' => $monthlyRent->stallContract->stallOccupant->vendor->user->email
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
                        'return_url' => route('payments.check-monthly-rent-payment', $monthlyRent->id)
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
        $monthlyRents = MonthlyRent::whereHas('stallContract', function ($query){
            $query->whereHas('stallOccupant', function ($query) {
                $query->where('vendor_id', auth()->user()->vendor->id);
            })
            ->whereNotIn('status', ['CANCELLED', 'TERMINATED']);
        })
        ->paginate(20);
        return view('livewire.vendor.fee.monthly-rent-index', [
            'monthlyRents' => $monthlyRents
        ]);
    }
}
