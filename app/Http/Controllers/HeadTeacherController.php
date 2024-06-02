<?php

namespace App\Http\Controllers;
use App\Models\HeadTeacher;
use App\Models\User;
use App\Models\TeacherClass;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        //
        $inputData=$request->all();

        $data=HeadTeacher::create([
            "UserId"=> $inputData["userId"],
            "SchoolId"=> $inputData["schoolId"]
        ]);

        return response()->json($data);
    }

    public function listAllHeadTeacher(Request $request){
        $data=$request->all();
        $data1=$data['HeadTeacher'];
      
        $data=User::leftJoin('head_teachers', 'users.id','=','head_teachers.UserId') 
        ->leftJoin('schools','head_teachers.SchoolId' , '=','schools.id' )
        ->get(['users.id','users.created_at','users.firstName','users.lastName','users.email','users.Telephone','schools.SchoolCode','schools.SchoolName']);
        return response()->json($data);

        // $data=User::leftJoin('head_teachers', 'users.id','=','head_teachers.UserId') 
        // ->leftJoin('schools','head_teachers.SchoolId' , '=','schools.id' )
        // ->where('users.position','=',$data1)
        // ->get(['users.id','users.created_at','users.firstName','users.lastName','users.email','users.Telephone','schools.SchoolCode','schools.SchoolName']);
        // return response()->json($data);
    }
    
    public function listAllTeacher(){
        $data=User::leftJoin('head_teachers', 'users.id','=','head_teachers.UserId') 
        ->leftJoin('schools','head_teachers.SchoolId' , '=','schools.id' )
        ->leftJoin('teacher_classes','teacher_classes.TeacherId' , '=','users.id' )
        ->leftJoin('school_classes','teacher_classes.ClassId' , '=','school_classes.id' )
        ->where('users.position','=','teacher')
        ->where('schools.SchoolCode','=','001')
        ->get(['users.id','users.created_at','users.firstName','users.lastName','users.email','users.Telephone','schools.SchoolName','school_classes.SchoolClass']);
        return response()->json($data);
        $data=HeadTeacher::where("SchoolCode",'001' )->where('position','Teacher')->get();
        return response()->json($data);
    }

    public function assignClassToTeacher(Request $request){
        $inputData=$request->all();
        //return response()->json($inputData);
        $data=TeacherClass::create([
            "TeacherId"=> $inputData["TeacherId"],
            "ClassId"=> $inputData["ClassId"]
        ]);
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
