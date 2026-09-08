<?php
namespace App\Http\Controllers\Gateway;

use App\Models\PaymentGateway;
use Illuminate\Support\Str;
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;

class Authorize
{

    public static function initiate($payment_data)
    {

        $payment_amount = $payment_data['amount'];

        $status = 0;
        $message = '';
        $txn_id = '';

        $data = PaymentGateway::whereKeyword('authorize')->first();
        $paydata = $data->convertAutoData();
        $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
        $merchantAuthentication->setName($paydata['login_id']);
        $merchantAuthentication->setTransactionKey($paydata['txn_key']);
        // Set the transaction's refId
        $refId = 'ref' . time();
        // Create the payment data for a credit card
        $creditCard = new AnetAPI\CreditCardType();
        $creditCard->setCardNumber(str_replace(' ', '', $payment_data['card_number']));
        $year = $payment_data['expiry_year'];
        $month = $payment_data['expiry_month'];
        $creditCard->setExpirationDate($year . '-' . $month);
        $creditCard->setCardCode($payment_data['cvv']);

        // Add the payment data to a paymentType object
        $paymentOne = new AnetAPI\PaymentType();
        $paymentOne->setCreditCard($creditCard);

        // Create order information
        $orderr = new AnetAPI\OrderType();
        $orderr->setInvoiceNumber(Str::random(8));
        $orderr->setDescription("Payment Description");
        // Create a TransactionRequestType object and add the previous objects to it
        $transactionRequestType = new AnetAPI\TransactionRequestType();
        $transactionRequestType->setTransactionType("authCaptureTransaction");
        $transactionRequestType->setAmount($payment_amount);
        $transactionRequestType->setOrder($orderr);
        $transactionRequestType->setPayment($paymentOne);
        // Assemble the complete transaction request
        $requestt = new AnetAPI\CreateTransactionRequest();
        $requestt->setMerchantAuthentication($merchantAuthentication);
        $requestt->setRefId($refId);
        $requestt->setTransactionRequest($transactionRequestType);

        // Create the controller and get the response
        $controller = new AnetController\CreateTransactionController($requestt);
        if ($paydata['sandbox_check'] == 1) {
            $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);
        } else {
            $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::PRODUCTION);
        }

        if ($response != null) {
            if ($response->getMessages()->getResultCode() == "Ok") {
                $tresponse = $response->getTransactionResponse();
                if ($tresponse != null && $tresponse->getMessages() != null) {
                    $status = 1;
                    $txn_id = $tresponse->getTransId();
                } else {
                    $message = __('Payment Failed.');
                }
            } else {
                $message = __('Card Information is not valid');
            }
        } else {
            $message = __('Payment Failed.');
        }

        storeStorage($txn_id, $payment_data);

        return ['status' => $status, 'txn_id' => $txn_id, "access_id"=>$txn_id, "authorize" => true,"redirect" => false, 'message' => $message];

    }
}
