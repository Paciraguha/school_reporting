<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;
use App\Models\School;
use App\Models\HeadTeacher;
use App\Models\Sector;
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
            $school="";


            if($user['position']=='DOS'|| $user['position']=='HeadTeacher'){
                $school=HeadTeacher::where('head_teachers.userId','=',$user['id'])
                                   ->join("schools",'schools.id','=','head_teachers.SchoolId')
                                   ->join("sectors",'sectors.SectorCode','=','schools.SectorCode')
                                   ->first();
            }

            if($user['position']=='Teacher'){
                $school=HeadTeacher::where('head_teachers.userId','=',$user['id'])
                                   ->join("schools",'schools.id','=','head_teachers.SchoolId')
                                   ->join("teacher_classes",'teacher_classes.TeacherId','=','head_teachers.id')
                                   ->join("school_classes",'teacher_classes.ClassId','=','school_classes.id')
                                   ->join("sectors",'sectors.SectorCode','=','schools.SectorCode')
                                   ->first();
            }

            
            if($user['position']=='SEO'){
                $school=Sector::leftJoin('sector_leaders','sector_leaders.SectorId','=','sectors.id')
                ->leftJoin('users','users.id','=','sector_leaders.userId')
                ->first();
            }
    
    
            return response()->json([
                    'status'=>true,
                    'message'=>'user logedin successfully',
                    'user'=>$user,
                    "post"=>$school,
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
