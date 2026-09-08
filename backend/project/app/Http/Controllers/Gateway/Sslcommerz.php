<?php

namespace App\Http\Controllers\Gateway;

use App\Http\Controllers\Api\PaymentGatewayController;
use App\Http\Controllers\Controller;
use App\Models\PaymentGateway;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class Sslcommerz extends Controller
{

    public static function initiate($payment_data)
    {
        $data = PaymentGateway::whereKeyword('sslcommerz')->first();
        $paydata = $data->convertAutoData();

        $txnid = Str::random(20);
        $payment_amount = $payment_data['amount'];

        $post_data = array();
        $post_data['store_id'] = $paydata['store_id'];
        $post_data['store_passwd'] = $paydata['store_password'];
        $post_data['total_amount'] = $payment_amount;
        $post_data['currency'] = 'BDT';
        $post_data['tran_id'] = $txnid;
        $post_data['success_url'] = route('sslcommerz.notify');
        $post_data['fail_url'] = fronturl()."/checkout/fail?message=Pament Failed&slug" . $payment_data['campaign'];
        $post_data['cancel_url'] = fronturl()."/checkout/fail?message=Pament Failed&slug" . $payment_data['campaign'];
        # $post_data['multi_card_name'] = "mastercard,visacard,amexcard";  # DISABLE TO DISPLAY ALL AVAILABLE

        $bill_info = Session::get('billing_address');
        # CUSTOMER INFORMATION
        $post_data['cus_name'] = "";
        $post_data['cus_email'] = "";
        $post_data['cus_add1'] = '';
        $post_data['cus_city'] = '';
        $post_data['cus_postcode'] = '';
        $post_data['cus_country'] = '';
        $post_data['cus_phone'] = "";
        $post_data['cus_fax'] = '';

        # REQUEST SEND TO SSLCOMMERZ
        if ($paydata['sandbox_check'] == 1) {
            $direct_api_url = "https://sandbox.sslcommerz.com/gwprocess/v3/api.php";
        } else {
            $direct_api_url = "https://securepay.sslcommerz.com/gwprocess/v3/api.php";
        }

        $handle = curl_init();
        curl_setopt($handle, CURLOPT_URL, $direct_api_url);
        curl_setopt($handle, CURLOPT_TIMEOUT, 30);
        curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($handle, CURLOPT_POST, 1);
        curl_setopt($handle, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false); # KEEP IT FALSE IF YOU RUN FROM LOCAL PC

        $content = curl_exec($handle);

        $code = curl_getinfo($handle, CURLINFO_HTTP_CODE);

        if ($code == 200 && !(curl_errno($handle))) {
            curl_close($handle);
            $sslcommerzResponse = $content;
        } else {
            curl_close($handle);
            return ['status' => 0, 'message' => "FAILED TO CONNECT WITH SSLCOMMERZ API"];

            exit;
        }

        # PARSE THE JSON RESPONSE
        $sslcz = json_decode($sslcommerzResponse, true);

        if (isset($sslcz['GatewayPageURL']) && $sslcz['GatewayPageURL'] != "") {
            $sslcz['GatewayPageURL'];
            storeStorage($txnid, $payment_data);
            return ['status' => 1, 'url' => $sslcz['GatewayPageURL']];
            exit;
        } else {
            return ['status' => 0, 'message' => "JSON Data parsing error!"];

        }
    }

    public function notify(Request $request)
    {
        if ($request->status == 'VALID') {
            $status = 1;
            $txn_id = $request->tran_id;
            $message = "Payment Successful";
        } else {
            $status = 0;
            $txn_id = '';
            $message = "Payment Field";

        }

        return (new PaymentGatewayController)->notifyOperation(['message' => $message, 'status' => $status, 'txn_id' => $txn_id, 'access_id' => $request->tran_id]);
    }
}
