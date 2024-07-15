<?php

namespace App\Http\Controllers;
use App\Models\HeadTeacher;
use App\Models\User;
use App\Models\TeacherClass;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth; 

class HeadTeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
      
        $inputData=$request->all();
       
       $data = HeadTeacher::where('userId', $inputData["userId"])->first();
        if($data){
            $data->update(["SchoolId" => $inputData["schoolId"]]);
        }else{
            $data=HeadTeacher::create([
                "userId"=> $inputData["userId"],
                "SchoolId"=> $inputData["schoolId"]
            ]);
        }
      
        return response()->json($data);
    }

    public function listAllHeadTeacher(Request $request){
        $data=$request->all();
        $data1=$data['HeadTeacher'];
      
        // $data=User::leftJoin('head_teachers', 'users.id','=','head_teachers.UserId') 
        // ->leftJoin('schools','head_teachers.SchoolId' , '=','schools.id' )
        // ->get(['users.id','users.created_at','users.firstName','users.lastName','users.email','users.Telephone','schools.SchoolCode','schools.SchoolName']);
        // return response()->json($data);

        $data=User::leftJoin('head_teachers', 'users.id','=','head_teachers.UserId') 
        ->leftJoin('schools','head_teachers.SchoolId' , '=','schools.id' )
        ->where('users.position','=',$data1)
        ->get(['users.id','users.created_at','users.firstName','users.lastName','users.email','users.Telephone','schools.SchoolCode','schools.SchoolName']);
        return response()->json($data);
    }
    
    public function listAllTeacher(){
        $this->middleware('auth:sanctum');
        $user_id=Auth::user()->id;
        //return response()->json($user_id);
        $user=User::Join('head_teachers', 'users.id','=','head_teachers.UserId') 
        ->Join('schools','head_teachers.SchoolId' , '=','schools.id' )
        ->where('users.id','=',$user_id)
        ->get(['schools.SchoolCode']);
      // return response()->json($user);
        $data=User::leftJoin('head_teachers', 'users.id','=','head_teachers.UserId') 
        ->leftJoin('schools','head_teachers.SchoolId' , '=','schools.id' )
        ->leftJoin('teacher_classes','teacher_classes.TeacherId' , '=','users.id' )
        ->leftJoin('school_classes','teacher_classes.ClassId' , '=','school_classes.id')
        ->where('users.position','=','teacher')
        ->where('schools.SchoolCode','=',$user[0]["SchoolCode"])
        ->get(['users.id','users.created_at','users.firstName','users.lastName','users.email','users.Telephone','schools.SchoolName','school_classes.SchoolClass']);
        return response()->json($data);

        $data=HeadTeacher::where("SchoolCode",$user[0]["SchoolCode"] )->where('position','Teacher')->get();
        return response()->json($data);

    }

    public function assignClassToTeacher(Request $request){
        $inputData=$request->all();

        $data =TeacherClass::where("TeacherId", $inputData["TeacherId"])
       ->first();

       if($data){
           $data->update(["ClassId"=> $inputData["ClassId"]]);
       }else{
           $data=TeacherClass::create([
            "TeacherId"=> $inputData["TeacherId"],
            "ClassId"=> $inputData["ClassId"]
        ]);
       }
        return response()->json($data);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
