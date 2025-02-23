<?php

namespace App\Http\Controllers;

use Safaricom\Mpesa\Mpesa;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
  public function getAccessToken()
  {
    $consumerKey = env('MPESA_CONSUMER_KEY');
    $consumerSecret = env('MPESA_CONSUMER_SECRET');

    $url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/json; charset=utf8']);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_USERPWD, $consumerKey . ":" . $consumerSecret);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($curl);
    curl_close($curl);

    $result = json_decode($response);

    if (!isset($result->access_token)) {
        return response()->json(['error' => 'hey, Failed to get access token']);
    }

    return $result->access_token;
  }
  public function pay(Request $request)
  {
      $mpesa = new Mpesa();
      $accessToken = $this->getAccessToken(); // Get the token manually

      if (!$accessToken) {
          return response()->json(['error' => 'Failed to obtain access token'], 500);
      }
      // $BusinessShortCode = "174379";
      // $LipaNaMpesaPasskey = "bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919";
      $BusinessShortCode = env('MPESA_SHORTCODE');
      $LipaNaMpesaPasskey = env('MPESA_PASSKEY');
      $TransactionType = "CustomerPayBillOnline"; //Money goes to a PayBill account Users enter their account number (e.g., student ID)
      // $TransactionType = "CustomerBuyGoodsOnline"; // Use for Till Numbers
      // $TransactionType = "CustomerToCustomerTransfer"; // Peer-to-peer transfer
      $Amount = $request->amount;
      $PartyA = $request->phone;
      // $PartyB = "254711251103";
      $PartyB = env('MPESA_SHORTCODE');  // The Paybill/Till Number receiving the payment
      $PhoneNumber = $request->phone;
      // $CallBackURL = url('/mpesa/callback');
      $CallBackURL = url('https://818b-41-90-176-71.ngrok-free.app');
      $AccountReference = "Fee Payment";
      $TransactionDesc = "School Fees Payment";
      $Remarks = "Payment for school fees";
    // $AccountReference = "P2P Transfer"; // Description
    // $TransactionDesc = "Sending money to another user";
    // $Remarks = "Peer-to-Peer Payment";

      $response = $mpesa->STKPushSimulation(
          $BusinessShortCode,
          $LipaNaMpesaPasskey,
          $TransactionType,
          $Amount,
          $PartyA,
          $PartyB,
          $PhoneNumber,
          $CallBackURL,
          $AccountReference,
          $TransactionDesc,
          $Remarks
      );

      return response()->json($response);
  }
}
