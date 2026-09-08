<?php

namespace App\Http\Controllers\Gateway;

class Manual
{

    public static function initiate($request, $payment_data, $type)
    {
        $status = 1;
        $message = '';
        $txn_id = str_rand();
        return ['status' => $status, 'txn_id' => $txn_id, 'message' => $message];
    }
}
