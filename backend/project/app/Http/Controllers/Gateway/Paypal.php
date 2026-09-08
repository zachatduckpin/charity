<?php

namespace App\Http\Controllers\Gateway;

use App\Http\Controllers\Api\PaymentGatewayController;
use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\PaymentGateway;
use Illuminate\Http\Request;
use Omnipay\Omnipay;

class Paypal extends Controller
{

    public static function initiate($payment_data)
    {
        $campaign = Campaign::where('slug', $payment_data['campaign'])->first();
        $cancel_url = fronturl().'/checkout/cancel?slug=' . $campaign->slug;

        $payment_amount = $payment_data['amount'];

        $data = PaymentGateway::whereKeyword('paypal')->first();
        $paydata = $data->convertAutoData();
        $gateway = Omnipay::create('PayPal_Rest');
        $gateway->setClientId($paydata['client_id']);
        $gateway->setSecret($paydata['client_secret']);
        $gateway->setTestMode(true);

        $notify_url = route('paypal.notify');

        try {
            $response = $gateway->purchase(array(
                'amount' => $payment_amount,
                'currency' => apiCurrency($payment_data['currency_id'])->code,
                'returnUrl' => $notify_url,
                'cancelUrl' => $cancel_url,
            ))->send();

            $payid = $response->getTransactionReference();

            // Save payment data to a file
            storeStorage($payid, $payment_data);

            if ($response->isRedirect()) {
                if ($response->getRedirectUrl()) {
                    return ['status' => 1, 'url' => $response->getRedirectUrl()];
                }
            } else {
                return ['status' => 0, 'message' => $response->getMessage()];
            }
        } catch (\Throwable $th) {
            return ['status' => 2, 'message' => $th->getMessage()];
        }
    }

    public function notify(Request $request)
    {

        $message = '';
        $status = 0;
        $txn_id = '';

        $responseData = $request->all();

        if (empty($responseData['PayerID']) || empty($responseData['token'])) {
            return [
                'status' => false,
                'message' => __('Unknown error occurred'),
            ];
        }

        $data = PaymentGateway::whereKeyword('paypal')->first();
        $paydata = $data->convertAutoData();
        $gateway = Omnipay::create('PayPal_Rest');
        $gateway->setClientId($paydata['client_id']);
        $gateway->setSecret($paydata['client_secret']);
        $gateway->setTestMode(true);
        $transaction = $gateway->completePurchase(array(
            'payer_id' => $responseData['PayerID'],
            'transactionReference' => $responseData['paymentId'],
        ));

        $response = $transaction->send();
        if ($response->isSuccessful()) {
            $txn_id = $response->getData()['transactions'][0]['related_resources'][0]['sale']['id'];
            $status = 1;
        }

        return (new PaymentGatewayController)->notifyOperation(['message' => $message, 'status' => $status, 'txn_id' => $txn_id, 'access_id' => $request->paymentId]);
    }
}
