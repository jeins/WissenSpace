<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use App\Veritrans\Midtrans;
use Illuminate\Http\Request;
use App\Models\MidtransCheckout;
use App\Http\Controllers\Controller;

class SnapController extends Controller
{
    public function __construct()
    {
        Midtrans::$serverKey = 'VT-server-VSIcsDriWMtI3W79Xc-emWG7';
        //set is production to true for production mode
        Midtrans::$isProduction = false;
    }

    public function snap()
    {
        return view('checkout/snap_checkout');
    }

    public function token()
    {
        // error_log('midtrans, snapcontroller: masuk ke snap token dri ajax');
        $midtrans = new Midtrans;

        //===========================
        //TODO:: make it as parameter
        //ACHTUNG::  ORDER ID BISA DOUBLE!!
        $price = 150000;
        $month = 1;
        $user_id = '28 ini id user';
        //===========================

        $transaction_details = [
            'order_id'      => uniqid(),
            'gross_amount'  => $price
        ];

        // Populate items
        $items = [
            [
                'id'        => 'item1',
                'price'     => $price,
                'quantity'  => 1,
                'name'      => 'Premium '. $month . ' Bulan'
            ]
        ];

        // Data yang akan dikirim untuk request redirect_url.
        $credit_card['secure'] = true;
        //ser save_card true to enable oneclick or 2click
        //$credit_card['save_card'] = true;
        $time = time();
        $custom_expiry = [
            'start_time' => date("Y-m-d H:i:s O",$time),
            'unit'       => 'hour',
            'duration'   => 2
        ];

        $transaction_data = [
            'transaction_details'=> $transaction_details,
            'item_details'       => $items,
            'customer_details'   => [],
            'credit_card'        => $credit_card,
            'expiry'             => $custom_expiry,
            'language'           => 'id',
            'user_id'            => $user_id,
        ];

        try {
            MidtransCheckout::create([
                'order_id' => $transaction_details['order_id'],
                'user_id'  => $user_id,
                'price'    =>  $price
            ]);

            $snap_token = $midtrans->getSnapToken($transaction_data);
            //return redirect($vtweb_url);
            echo $snap_token;
        }
        catch (Exception $e) {
            return $e->getMessage;
        }
    }

    public function finish(Request $request)
    {
        $result = $request->input('result_data');
        $result = json_decode($result);
        echo 'this is finish method <br>';
        echo $result->status_message . '<br>';

        dd($result);
    }

    public function notification()
    {
        $midtrans = new Midtrans;
        // echo 'test notification handler';
        $json_result = file_get_contents('php://input');
        $result      = json_decode($json_result);

        // TODO HILMAN
        // try save the result on database
        // check if user id and months is there !!
        //


        if($result){
            $notif = $midtrans->status($result->order_id);

            //order id bisa double! prevent check database on created
            //@ first method
            //TODO: return 200?

            MidtransCheckout::where('id', 1)
                            ->update([
                                        'status' => 1,
                                        'subject' => $result,
                                        'subject_notif' => $notif
                                    ]);
        }

        // error_log(print_r($result,TRUE));

        return response()->json(['success' => 'success'], 200);
        /*
        $transaction = $notif->transaction_status;
        $type = $notif->payment_type;
        $order_id = $notif->order_id;
        $fraud = $notif->fraud_status;
        if ($transaction == 'capture') {
          // For credit card transaction, we need to check whether transaction is challenge by FDS or not
          if ($type == 'credit_card'){
            if($fraud == 'challenge'){
              // TODO set payment status in merchant's database to 'Challenge by FDS'
              // TODO merchant should decide whether this transaction is authorized or not in MAP
              echo "Transaction order_id: " . $order_id ." is challenged by FDS";
              }
              else {
              // TODO set payment status in merchant's database to 'Success'
              echo "Transaction order_id: " . $order_id ." successfully captured using " . $type;
              }
            }
          }
        else if ($transaction == 'settlement'){
          // TODO set payment status in merchant's database to 'Settlement'
          echo "Transaction order_id: " . $order_id ." successfully transfered using " . $type;
          }
          else if($transaction == 'pending'){
          // TODO set payment status in merchant's database to 'Pending'
          echo "Waiting customer to finish transaction order_id: " . $order_id . " using " . $type;
          }
          else if ($transaction == 'deny') {
          // TODO set payment status in merchant's database to 'Denied'
          echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is denied.";
        }*/

    }
}
