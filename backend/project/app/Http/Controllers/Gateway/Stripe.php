<?php

namespace App\Http\Controllers\Gateway;

use App\Http\Controllers\Api\PaymentGatewayController;
use App\Models\Campaign;
use App\Models\PaymentGateway;
use Illuminate\Http\Request;

class Stripe
{

    public static function initiate($payment_data)
    {

        try {
            $campaign = Campaign::where('slug', $payment_data['campaign'])->first();
            $cancel_url =fronturl(). '/checkout/cancel?slug=' . $campaign->slug;

            // SERIALIZE DATA
            $payment_amount = $payment_data['amount'];

            $data = PaymentGateway::whereKeyword('stripe')->first();
            $paydata = $data->convertAutoData();

            $stripe_secret_key = $paydata['secret'];
            \Stripe\Stripe::setApiKey($stripe_secret_key);
            $checkout_session = \Stripe\Checkout\Session::create([
                "mode" => "payment",
                "success_url" => route('stripe.notify') . '?session_id={CHECKOUT_SESSION_ID}',
                "cancel_url" => $cancel_url,
                "locale" => "auto",
                "customer_email" => $payment_data['email'] ? $payment_data['email'] : null,
                "line_items" => [
                    [
                        "quantity" => 1,
                        "price_data" => [
                            "currency" => apiCurrency($payment_data['currency_id'])->code,
                            "unit_amount" => $payment_amount * 100,
                            "product_data" => [
                                "name" => 'Payment for donation',
                            ],
                        ],
                    ],

                ],
            ]);

            if ($checkout_session->id) {
                storeStorage($checkout_session->id, $payment_data);
                return ['status' => 1, 'url' => $checkout_session->url];
            } else {
                return ['status' => 0, 'message' => 'Something went wrong'];
            }

        } catch (\Exception $e) {
            return ['status' => 0, 'message' => $e->getMessage()];
        }

    }

    public function notify(Request $request)
    {

        $status = 0;
        $message = '';
        $txn_id = '';

        $data = PaymentGateway::whereKeyword('stripe')->first();
        $paydata = $data->convertAutoData();
        $stripe_secret_key = $paydata['secret'];
        $stripe = new \Stripe\StripeClient($stripe_secret_key);
        $response = $stripe->checkout->sessions->retrieve($request->session_id);
        if ($response->status == 'complete' && $response->payment_status == 'paid') {
            $status = 1;
            $txn_id = $response->payment_intent;
        } else {
            $message = __('Payment Field Please Try again');
        }

        return (new PaymentGatewayController)->notifyOperation(['message' => $message, 'status' => $status, 'txn_id' => $txn_id, 'access_id' => $request->session_id]);
    }
}
