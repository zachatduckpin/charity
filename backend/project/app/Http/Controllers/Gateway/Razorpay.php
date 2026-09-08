<?php

namespace App\Http\Controllers\Gateway;

use App\Http\Controllers\Api\PaymentGatewayController;
use App\Models\Generalsetting;
use App\Models\PaymentGateway;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Razorpay\Api\Api;

class Razorpay
{

    public static function initiate($payment_data)
    {

        $data = PaymentGateway::whereKeyword('razorpay')->first();
        $paydata = $data->convertAutoData();
        $keyId = $paydata['key'];
        $keySecret = $paydata['secret'];
        $displayCurrency = apiCurrency($payment_data['currency_id'])->code;
        $api = new Api($keyId, $keySecret);

        $payment_amount = $payment_data['amount'];
        $order_number = Str::random(8);

        $data = PaymentGateway::whereKeyword('razorpay')->first();

        $orderData = [
            'receipt' => $order_number,
            'amount' => $payment_amount * 100, // 2000 rupees in paise
            'currency' => apiCurrency($payment_data['currency_id'])->code,
            'payment_capture' => 1, // auto capture
        ];

        $razorpayOrder = $api->order->create($orderData);

        Session::put('order_payment_id', $razorpayOrder['id']);

        $amount = $orderData['amount'] / 100;

        if ($displayCurrency !== apiCurrency($payment_data['currency_id'])->code) {
            $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
            $exchange = json_decode(file_get_contents($url), true);
        }

        $gs = Generalsetting::first();

        $data = [
            "key" => $keyId,
            "amount" => $amount,
            "name" => "",
            "currency" => $displayCurrency,
            "image" => getPhoto($gs->header_logo),
            "mid" => $order_number,
            "prefill" => [
                "name" => isset($payment_data->name) ? $payment_data->name : '',
                "email" => isset($payment_data->email) ? isset($payment_data->email) : '',
                "contact" => "",
            ],
            "order_id" => $razorpayOrder['id'],
        ];

        // Save order data to file
        storeStorage($razorpayOrder['id'], $payment_data);
     
        $json = json_encode($data, true);
        $displayCurrency = $displayCurrency;

        return ['status' => 1, 'json' => $json, 'notify_url' => route('razorpay.notify') . '?access_id=' . $razorpayOrder['id']];
    }

    public function notify(Request $request)
    {

        // api init
        $data = PaymentGateway::whereKeyword('razorpay')->first();
        $paydata = $data->convertAutoData();
        $keyId = $paydata['key'];
        $keySecret = $paydata['secret'];
        $api = new Api($keyId, $keySecret);

        // login start
        $status = 0;
        $message = '';
        $txn_id = '';
        $success = true;

        $input_data = $request->all();
        if (empty($input_data['razorpay_payment_id']) === false) {
            try {
                $attributes = array(
                    'razorpay_order_id' => $input_data['access_id'],
                    'razorpay_payment_id' => $input_data['razorpay_payment_id'],
                    'razorpay_signature' => $input_data['razorpay_signature'],
                );
                $api->utility->verifyPaymentSignature($attributes);
            } catch (SignatureVerificationError $e) {
                $success = false;
            }
        }

        if ($success === true) {
            $status = 1;
            $txn_id = $input_data['razorpay_payment_id'];
        } else {
            $message = "Payment Field";
        }

        return (new PaymentGatewayController)->notifyOperation(['message' => $message, 'status' => $status, 'txn_id' => $txn_id, 'access_id' => $request['access_id']]);
    }
}
