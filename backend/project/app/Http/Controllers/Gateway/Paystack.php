<?php

namespace App\Http\Controllers\Gateway;

use App\Http\Controllers\Api\PaymentGatewayController;
use App\Models\PaymentGateway;
use Illuminate\Http\Request;

class Paystack
{

    public static function initiate($payment_data, )
    {

        $data = PaymentGateway::whereKeyword('paystack')->first();
        $paydata = $data->convertAutoData();
        $status = 1;

        storeStorage("paystack_request", $payment_data);

        $notify_url = route('paystack.notify');

        $json = [
            "amount" => $payment_data['amount'],
            "email" => $paydata['email'] ?? '',
            "public_key" => $paydata['key'],
        ];
        $json = json_encode($json, true);
        return ['status' => $status, 'json' => $json, 'notify_url' => $notify_url, "gateway" => "paystack", "slug" => $payment_data['campaign']];
    }

    public function notify(Request $request)
    {

        $status = 0;
        $message = '';
        $txn_id = '';

        $input_data = $request->all();
        if ($input_data['trans']) {
            $status = 1;
            $txn_id = $input_data['trans'];
        } else {
            $message = "Payment Field";
        }


        return (new PaymentGatewayController)->notifyOperation(['message' => $message, 'status' => $status, 'txn_id' => $txn_id, 'access_id' => "paystack_request","redirect"=>false]);
    }
}
