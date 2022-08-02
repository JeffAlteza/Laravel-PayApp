<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use App\Models\logs;
use App\Models\payment_transaction;
use Validator;


class AdminController extends Controller
{
    public function create_user(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if($user){
            return response()->json(['message' => 'Email already exists'], 400);
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:255',
            'email' => 'required|email',
            'password' => 'required|min:8',
            'c_password' => 'required|same:password',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }
        $data=[
            "name"=> $request->name,
            "email"=> $request->email,
            "password"=> bcrypt($request->password),
        ];
        $user= User::create($data);
        $token=$user->createToken('SecretToken')->accessToken;
        $user->token=$token;
        return response()->json([
            'status' => true,
            'message' => 'User Created Succesfully',
            'data' => $user,
        ],
        200);
    }

    public function show(Request $request)
    {
        $user = User::all();
        return response()->json([
            'data' => $user,],
        200);
    }

    public function show_payment_transactions(Request $request)
    {
        $payment_transaction = payment_transaction::all();
        return response()->json([
            'data' => $payment_transaction,],
        200);
        //return view('main',['data'=>$payment_transaction]);
    }

    public function update(Request $request, $id) {
        $user = User::find($id);
        if(is_null($user)) {
            return response()->json(['message' => 'User Not Found'], 404);
        }
        $user->update($request->all());
        return response($user, 200);
    }

    public function delete(Request $request, $id)
    {
        $user= User::find($id);
        $user->delete();
        return response()->json([
            'status' => true,
            'message' => 'Succesfully Deleted',
            'data' => $user,
        ],200);

    }

    public function login(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];
        $user = User::where('email', $request->email)->first();
        if (auth()->attempt($data)) {
            $token = auth()->user()->createToken('SecretToken')->accessToken;
            //$user = User::all();
            return response()->json([
            'status' => true,
            'message' => 'Succesfully Logged in',
            'token' => $token,
            'data' => $user,
        ], 200);
        } else {
            return response()->json(['error' => 'Hashash'], 401);
        }
    }

    public function sampleLog(Request $request){
        
        if($request->email=="admin" && $request->password=="admin"){
            
            
            return response()->json([
            'status' => true,
            'message' => 'Succesfully Logged in'
            
        ], 200);
        }
        else{
            return response()->json(['error' => 'Unauthorized'], 401);
        }

    }

    //display logs
    public function show_logs(Request $request)
    {
        $logs = logs::all();
        return response()->json([
            'data' => $logs,],
        200);
    }
}
