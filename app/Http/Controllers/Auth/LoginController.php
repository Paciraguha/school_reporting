<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;



class LoginController extends Controller
{
    public function userLogin(Request $request){
        try {
            $data=$request->all();
            $validator= Validator::make($data, [
                
                'email' => ['required', 'email'],
                'password' => ['required']
            ]);

            if($validator->fails()){
                return response()->json([
                    'status'=>false,
                    'message'=>'validation error',
                    'error'=>$validator->errors()
                ],401);
            }
    

            if(!Auth::attempt($request->only(['email','password']))){
                return response()->json([
                    'status'=>false,
                    'message'=>'Email and Password not match please try again',
                    
                ],200);  
            };

            $user= User::where('email', $data['email'])->first();
            
    
            return response()->json([
                    'status'=>true,
                    'message'=>'user logedin successfully',
                    'user'=>$user,
                    'token'=>$user->createToken("API TOKEN")->plainTextToken
                ],200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'status'=>false,
                'message'=>$th->getMessage()
                
            ],500);
        }
        
    }
    
}
