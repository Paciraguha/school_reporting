<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(Request $request)
    {
       
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(Request $request)
    {

        try {
            $data=$request->all();
            $validator= Validator::make($data, [
                'firstName' => ['required', 'string', 'max:255'],
                'lastName' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255',"unique:users"],
                'telephone' => ['required', 'string', 'max:10',"unique:users"],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
            if($validator->fails()){
                return response()->json([
                    'status'=>false,
                    'message'=>'input validation fails',
                    'error'=>$validator->errors()
                ],401);
            }
    
            $user= User::create([
                'firstName' => $data['firstName'],
                'lastName' => $data['lastName'],
                'email' => $data['email'],
                'Telephone' => $data['telephone'],
                'Gender'=>$data['gender'],
                'position' => $data['position'],
                'password' => Hash::make($data['password']),
            ]);
    
         
            return response()->json([
                    'status'=>true,
                    'message'=>'user created successfully',
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
