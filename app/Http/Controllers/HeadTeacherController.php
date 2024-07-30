<?php

namespace App\Http\Controllers;
use App\Models\HeadTeacher;
use App\Models\User;
use App\Models\TeacherClass;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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

            $data->update(["SchoolId" => $inputData["schoolId"],"teachingLevel"=>$inputData["schoolLevel"]]);
        }else{
            $data=HeadTeacher::create([
                "userId"=> $inputData["userId"],
                "SchoolId"=> $inputData["schoolId"],
                "teachingLevel"=>$inputData["schoolLevel"],
            ]);
        }

        $data = User::where('id', $inputData["userId"])->first();
        if($data){
            $validator= Validator::make($inputData, [
                'firstName' => ['required', 'string', 'max:255'],
                'lastName' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255'],
                'telephone' => ['required', 'string', 'max:10'],
                
            ]);
            if($validator->fails()){
                return response()->json([
                    'status'=>false,
                    'message'=>'input validation fails, all field is mandatory',
                    'error'=>$validator->errors()
                ],400);
            }
    
            $data->update([
                'firstName' => $inputData['firstName'],
                'lastName' => $inputData['lastName'],
                'email' => $inputData['email'],
                'Telephone' => $inputData['telephone'],
                'Gender' => $inputData['gender'],
                'position' => $inputData['position']
            ]);
    
         
            return response()->json([
                    'status'=>true,
                    'message'=>'user information is successfully updated'
                ],200); 
        }
       
    }

    public function listAllHeadTeacher(Request $request){
        $data=$request->all();
        $data1=$data['HeadTeacher'];
      //  return response()->json($data1);
        // $data=User::leftJoin('head_teachers', 'users.id','=','head_teachers.UserId') 
        // ->leftJoin('schools','head_teachers.SchoolId' , '=','schools.id' )
        // ->get(['users.id','users.created_at','users.firstName','users.lastName','users.email','users.Telephone','schools.SchoolCode','schools.SchoolName']);
        // return response()->json($data);

        $data=User::leftJoin('head_teachers', 'users.id','=','head_teachers.UserId') 
        ->leftJoin('class_levels','head_teachers.teachingLevel' , '=','class_levels.id')
        ->leftJoin('schools','head_teachers.SchoolId' , '=','schools.id')
        ->leftJoin('sectors','sectors.SectorCode' , '=','schools.SectorCode')
        ->where('users.position','=',$data1)
        ->get(['users.id','users.created_at','users.firstName','users.lastName','users.email','users.Telephone','users.Gender','users.position','class_levels.levels','head_teachers.teachingLevel','schools.id as school_id','schools.SchoolCode','schools.SchoolName','sectors.SectorCode','sectors.SectorName']);
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
      
        $data=User::leftJoin('head_teachers', 'users.id','=','head_teachers.UserId') 
        ->Join('class_levels','head_teachers.teachingLevel' , '=','class_levels.id')
        ->leftJoin('schools','head_teachers.SchoolId' , '=','schools.id' )
        ->leftJoin('teacher_classes','teacher_classes.TeacherId' , '=','users.id' )
        ->leftJoin('school_classes','teacher_classes.ClassId' , '=','school_classes.id')
        ->leftJoin('teachers', 'users.id', '=', 'teachers.teacherId')
        ->where('users.position','=','teacher')
        ->where('schools.SchoolCode','=',$user[0]["SchoolCode"])
        ->groupBy('users.id',
            'users.created_at',
            'users.firstName',
            'users.lastName',
            'users.email',
            'users.Telephone',
            'schools.SchoolName',
            'class_levels.levels',
            'head_teachers.teachingLevel',
            'school_classes.SchoolClass')
        ->select(
            'users.id',
            'users.created_at',
            'users.firstName',
            'users.lastName',
            'users.email',
            'users.Telephone',
            'schools.SchoolName',
            'school_classes.SchoolClass',
            'class_levels.levels',
            'head_teachers.teachingLevel',
            DB::raw('COUNT(teachers.teacherId) as totalRegistered'),
            DB::raw('SUM(CASE WHEN teachers.status = "Present" THEN 1 ELSE 0 END) as totalPresent'),
            DB::raw('SUM(CASE WHEN teachers.status = "Absent" THEN 1 ELSE 0 END) as totalAbsent'),
        )
        ->get();
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
