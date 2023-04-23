<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Stripe\Charge;
use Stripe\Stripe;
use Illuminate\Http\Request;

class StripeController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required'
        ]) ;
        $payment = new Payment();
        $payment->amount = $request->amount;
        $payment->save();
        return response()->json([
            "payment" => $payment
        ], 200);
    }

    public function createCharge(Request $request)
    {
        $request->validate([
            'cardNumber' => 'required|string',
            'expiry' => 'required|regex:/^\d{2}\/\d{4}$/',
            'cvc' => 'required|string',
            'amount' => 'required|numeric|min:0.01',
        ]);

        $parts = explode('/', $request->expiry);
        $exp_month = (int) $parts[0];
        $exp_year = (int) $parts[1];
        $cardNumber = $request->cardNumber;
        $cvc = $request->cvc;
        $amount = (int) $request->amount * 100;
        $parts = explode('/', $request->expiry);

        try {
            $stripe = new \Stripe\StripeClient(
                env('STRIPE_SECRET')
            );
            $res = $stripe->tokens->create([
                'card' => [
                    'number' => $cardNumber,
                    'exp_month' => $exp_month,
                    'exp_year' => $exp_year,
                    'cvc' => $cvc,
                ],
            ]);
            $stripe = new \Stripe\StripeClient(
                env('STRIPE_SECRET')
            );
            $response = $stripe->charges->create([
                'amount' => $amount,
                'currency' => 'mad',
                'source' => $res->id,
                'description' => "Payement is well done",
            ]);
            return response()->json([
                'response' => $response->status
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }
}
