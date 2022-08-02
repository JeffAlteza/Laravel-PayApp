<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use App\Models\logs;
use App\Models\payment_transaction;
use Validator;

use Aceraven777\PayMaya\PayMayaSDK;
use Aceraven777\PayMaya\API\Checkout;
use Aceraven777\PayMaya\Model\Checkout\Item;
use App\Libraries\PayMaya\User as PayMayaUser;
use Aceraven777\PayMaya\Model\Checkout\ItemAmount;
use Aceraven777\PayMaya\Model\Checkout\ItemAmountDetails;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


 /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function proceed_payment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            
            'fullname' => 'required|min:3|max:255',
            'email' => 'required|email',
            'mobile_no' => 'required',
            'amount' => 'required',
            'payment_for' => 'required',
            'payment_method' => 'required',
            'paymaya_ref_no' => 'required',

        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $ref_id=uniqid();
        while(payment_transaction::where('transaction_id',$ref_id)->first()){
            $ref_id=uniqid();
        }
       
            $data=[
                "student_ref_no"=> $request->student_ref_no,
               
                "fullname"=> $request->fullname,
                "email"=> $request->email,
                "mobile_no"=> $request->mobile_no,
                "amount"=> $request->amount,
                "payment_for"=> $request->payment_for,
                "payment_method"=> $request->payment_method,
                "paymaya_ref_no"=> $request->paymaya_ref_no,
                "transaction_id"=> $ref_id,
                "status"=> "Pending",
            ];
            $user= payment_transaction::create($data);
            $token=$user->createToken('codesolution')->accessToken;
            $user->token=$token;
            
            $data=[
                "transaction_id"=> $ref_id,
                "name"=> $request->fullname,
                "logs"=> "Payment Request",
            ];

            $user= logs::create($data);


            PayMayaSDK::getInstance()->initCheckout(
                env('PAYMAYA_PUBLIC_KEY'),
                env('PAYMAYA_SECRET_KEY'),
                (\App::environment('production') ? 'PRODUCTION' : 'SANDBOX')
            );
        
            $payment= $request->payment_for;
            $amount= $request->amount;
            $mobile_no= $request->mobile_no;
            $email= $request->email;

            $sample_item_name = $payment;
            $sample_total_price = $amount;
        
            $sample_user_phone = $mobile_no;
            $sample_user_email = $email;
            
            $trans_id = $ref_id;
        
            // Item
            $itemAmountDetails = new ItemAmountDetails();
            $itemAmountDetails->tax = "0.00";
            $itemAmountDetails->subtotal = number_format($sample_total_price, 2, '.', '');
            $itemAmount = new ItemAmount();
            $itemAmount->currency = "PHP";
            $itemAmount->value = $itemAmountDetails->subtotal;
            $itemAmount->details = $itemAmountDetails;
            $item = new Item();
            $item->name = $sample_item_name;
            $item->amount = $itemAmount;
            $item->totalAmount = $itemAmount;
        
            // Checkout
            $itemCheckout = new Checkout();
        
            $user = new PayMayaUser(); 
            $user->contact->phone = $sample_user_phone;
            $user->contact->email = $sample_user_email;
        
            $itemCheckout->buyer = $user->buyerInfo();
            $itemCheckout->items = array($item);
            $itemCheckout->totalAmount = $itemAmount;
            $itemCheckout->requestReferenceNumber = $trans_id;
            $itemCheckout->redirectUrl = array(
                "success" => route('success_payment',['id'=>$ref_id]),
                "failure" => route('failed_transaction', ['id'=>$ref_id]),
                "cancel" => url('returl-url/cancel'.$ref_id),
            );
            
            if ($itemCheckout->execute() === false) {
                $error = $itemCheckout::getError();
                dd($error);
                //return response()->json(['message' => $error['message']]);
            }
        
            if ($itemCheckout->retrieve() === false) {
                $error = $itemCheckout::getError();
                return response()->json(['message' => $error['message']]);
            }
            return response()->json($itemCheckout->url);
    }





    public function success_payment($id){
        //update the status of the transaction to success
        $payment_transaction=payment_transaction::where('transaction_id',$id)->first();
        if($payment_transaction){
            $fullname=$payment_transaction->fullname;
            $data=[
                "transaction_id"=> $id,
                "name"=> $fullname,
                "logs"=> "Payment Successful",
            ];

            $user= logs::create($data);

            $payment_transaction->status="success";
            $payment_transaction->save();
            return redirect('http://localhost:4200/success');
        }else{  
            //return view('payment.failed');
            echo "failed update";
        }
    }


    public function failed_transaction($id){
        //update the status of the transaction to failed
        $payment_transaction=payment_transaction::where('transaction_id',$id)->first();
        if($payment_transaction){
            $fullname=$payment_transaction->fullname;
            $data=[
                "transaction_id"=> $id,
                "name"=> $fullname,
                "logs"=> "Payment Successful",
            ];

            $user= logs::create($data);

            $payment_transaction->status="failed";
            $payment_transaction->save();
            return redirect('http://localhost:4200/success');
        }else{  
            //return view('payment.failed');
            echo "failed update";
        }
        //return redirect('http://localhost:4200/error');
    }



}
