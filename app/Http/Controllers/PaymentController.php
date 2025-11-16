<?php

namespace App\Http\Controllers;

use App\Models\Fee;
use App\Models\MonthlyRent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use function Flasher\Notyf\Prime\notyf;

class PaymentController extends Controller
{
    private function auth()
    {
        return base64_encode(auth()->user()->vendor->appSettings()->paymongo_secret_key . ":");
    }
    //
    public function checkDailyCollectionPayment(Request $request, $fee_id) {
         $fee = Fee::find($fee_id);

        $intentData = json_decode($fee->payment_json);
        $payment_intent_id = $intentData->data->id;

        $statusResponse = Http::withHeaders([
            'Authorization' => "Basic " . $this->auth(),
        ])->get("https://api.paymongo.com/v1/payment_intents/{$payment_intent_id}");

        $status = $statusResponse->json()['data']['attributes']['status'];

        if ($status === 'succeeded') {
            $fee->update(['status' => 'PAID', 'date_paid' => now()]);
        }
        else {
            notyf()->position('y', 'top')->error('Payment failed.');
        }

        notyf()->position('y', 'top')->success('Payment marked as paid!');
        if(auth()->user()->isVendor()) {
            return redirect()->route('vendor.fees.index');
        }
        return redirect()->route('main.fees.index');
    }

    public function checkMonthlyRentPayment(Request $request, $monthly_rent_id) {
         $monthlyRent = MonthlyRent::find($monthly_rent_id);

        $intentData = json_decode($monthlyRent->payment_json);
        $payment_intent_id = $intentData->data->id;

        $statusResponse = Http::withHeaders([
            'Authorization' => "Basic " . $this->auth(),
        ])->get("https://api.paymongo.com/v1/payment_intents/{$payment_intent_id}");

        $status = $statusResponse->json()['data']['attributes']['status'];

        if ($status === 'succeeded') {
            $monthlyRent->update(['status' => 'PAID', 'payment_date' => now()]);
        }
        else {
            notyf()->position('y', 'top')->error('Payment failed.');
        }

        notyf()->position('y', 'top')->success('Payment marked as paid!');
        if(auth()->user()->isVendor()) {
            return redirect()->route('vendor.monthly-rents.index');
        }
        return redirect()->route('main.monthly-rents.index');
    }
}
