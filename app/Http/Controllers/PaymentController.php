<?php

namespace App\Http\Controllers;

use App\Models\Fee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use function Flasher\Notyf\Prime\notyf;

class PaymentController extends Controller
{
    private function auth()
    {
        return base64_encode(env('PAYMONGO_SECRET_KEY') . ":");
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

        if(auth()->user()->isVendor()) {
            return redirect()->route('vendor.fees.index');
        }
        return redirect()->route('main.fees.index');
    }
}
