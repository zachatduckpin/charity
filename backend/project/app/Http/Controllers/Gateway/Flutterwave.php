<?php

namespace App\Http\Controllers\Gateway;

use App\Http\Controllers\Api\PaymentGatewayController;
use App\Models\PaymentGateway;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Flutterwave
{
    public static function initiate($payment_data)
    {
        $data = PaymentGateway::whereKeyword('flutterwave')->first();
        $paydata = $data->convertAutoData();
        $public_key = $paydata['public_key'];

        $message = '';
        $status = 1;

        $curl = curl_init();
        // $payment_amount = $payment_data['amount'];
        $payment_amount = 1;

        $PBFPubKey = $public_key; // get your public key from the dashboard.
        $redirect_url = route('flutterwave.notify');

        $txref = Str::random(4) . time();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/hosted/pay",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode([
                'amount' => $payment_amount,
                'customer_email' => 'example@gmail.com',
                'currency' => apiCurrency($payment_data['currency_id'])->code,
                'txref' => $txref,
                'PBFPubKey' => $PBFPubKey,
                'redirect_url' => $redirect_url,
                'payment_plan' => '',
            ]),
            CURLOPT_HTTPHEADER => [
                "content-type: application/json",
                "cache-control: no-cache",
            ],
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        if ($err) {
            $status = 0;
            $message = 'Curl returned error: ' . $err;
        }

        $transaction = json_decode($response);

        if (!$transaction->data && !$transaction->data->link) {
            // there was an error from the API
            $status = 0;
            $message = 'API returned error: ' . $transaction->message;
        }

        storeStorage($txref, $payment_data);
        return ['status' => $status, 'message' => $message, 'url' => $transaction->data->link];

    }

    public function notify(Request $request)
    {

        $data = PaymentGateway::whereKeyword('flutterwave')->first();
        $paydata = $data->convertAutoData();
        $secret_key = $paydata['secret_key'];

        $message = '';
        $status = 0;
        $txn_id = '';

        $ref = $request->txref;
        $query = array(
            "SECKEY" => $secret_key,
            "txref" => $ref,
        );

        $data_string = json_encode($query);

        $ch = curl_init('https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/verify');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        $response = curl_exec($ch);
        curl_close($ch);
        $resp = json_decode($response, true);
        if ($resp['status'] = "success") {
            $paymentStatus = $resp['data']['status'];
            $chargeResponsecode = $resp['data']['chargecode'];

            if (($chargeResponsecode == "00" || $chargeResponsecode == "0") && ($paymentStatus == "successful")) {
                $txn_id = $resp['data']['txid'];
                $status = 1;
            }
        }

        return (new PaymentGatewayController)->notifyOperation(['message' => $message, 'status' => $status, 'txn_id' => $txn_id, 'access_id' => $request->txref]);
    }
}
