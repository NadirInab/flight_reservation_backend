<?php

namespace App\Http\Controllers;

use Stripe\Charge;
use Stripe\Stripe;
use Illuminate\Http\Request;

class StripeController extends Controller
{
    
    public function __construct()
    {
        // Set the Stripe API key
        Stripe::setApiKey(env('STRIPE_SECRET'));
    }
    public function createCharge(Request $request)
    {
        $amount = $request->input('amount');
        $currency = $request->input('currency');
        $token = $request->input('stripeToken');

        

        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        try {
            $charge = Charge::create([
                'amount' => $amount,
                'currency' => $currency,
                'source' => $token,
            ]);

            return response()->json(['success' => true, 'charge' => $charge]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }
}
