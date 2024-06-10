<?php

namespace App\Http\Controllers;
use App\Models\Student;
use App\Models\User;
use App\Models\studentsAttendance;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\DB;
class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function __construct()
     {
          $this->middleware('auth:sanctum');
         
        //   $user_id=Auth::user()->id;
        //   // $user=logeddInUser($user_id);
        //   //return response()->json($user_id);
        //   $user=User::Join('head_teachers', 'users.id','=','head_teachers.UserId') 
        //   ->Join('schools','head_teachers.SchoolId' , '=','schools.id' )
        //   ->where('users.id','=',$user_id)
         // ->get(['schools.SchoolCode']);
         
     }
     

 


    public function index()
    {
        //
        if (Auth::check()) {
             
            $this->middleware('auth:sanctum');
         
            $user_id=Auth::user()->id;
            $user=User::Join('head_teachers', 'users.id','=','head_teachers.UserId') 
            ->Join('schools','head_teachers.SchoolId' , '=','schools.id' )
            ->where('users.id','=',$user_id)
            ->get(['schools.SchoolCode']);


            $data=Student::join('school_classes','school_classes.id','=','students.ClassLevel')
            ->where('students.SchoolCode',$user[0]["SchoolCode"])
            ->get(['students.id','students.SchoolCode','students.FirstName','students.LastName','students.Gender','students.StudentCode','school_classes.SchoolClass']);
            return response()->json($data);

        } else {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }
    }

    /**
     * Show the form for creating a new resource.
     * 
     */
    public function getAllStudentAttendanceScore(){
        if (Auth::check()) {
             
            $this->middleware('auth:sanctum');
       
            $user_id=Auth::user()->id;
            $user=User::Join('head_teachers', 'users.id','=','head_teachers.UserId') 
            ->Join('schools','head_teachers.SchoolId' , '=','schools.id' )
            ->where('users.id','=',$user_id)
            ->get(['schools.SchoolCode']);

        
            $data = Student::join('school_classes', 'school_classes.id', '=', 'students.ClassLevel')
            ->join('students_attendances', 'students.id', '=', 'students_attendances.StudentCode')
            ->where('students.SchoolCode', $user[0]["SchoolCode"])
            ->groupBy('students_attendances.StudentCode','students.id', 'students.FirstName', 'students.LastName', 'students.Gender', 'students.StudentCode', 'school_classes.SchoolClass') // Add grouping by attendedDay
            ->select( 
                'students.id',
                'students.FirstName',  
                'students.LastName', 
                'students.Gender',
                'students.StudentCode',
                 'school_classes.SchoolClass',
                // Include student's first name
                DB::raw('COUNT(students_attendances.StudentCode) as totalRegistered'),
                DB::raw('SUM(CASE WHEN students_attendances.Status = "Present" THEN 1 ELSE 0 END) as totalPresent'),
                DB::raw('SUM(CASE WHEN students_attendances.Status = "Absent" THEN 1 ELSE 0 END) as totalAbsent'),
            )
            
            ->get();

            return response()->json($data);

            

        } else {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }
        
    }
    public function create(Request $request)
    {
        //
        $inputData=$request->all();
        
        $initial=10000;
        $school=Student::all()->count();
        $result=$initial+$school+1;
        $result=(string) $result;
        $result=substr($result,2);

        $studentCode="01001".$result;
        $data=Student::create([
            "StudentCode"=>$studentCode,
            "SchoolCode"=>$inputData["SchoolCode"],
            "ClassLevel"=>$inputData["ClassLevel"],
            "FirstName"=>$inputData["FirstName"],
            "LastName"=>$inputData["LastName"],
            "Gender"=>$inputData["Gender"],
        ]);
        return response()->json($data);
    }



    public function studentsAttendance(Request $request){
        $inputData=$request->all();

       $data = studentsAttendance::where('StudentCode', $inputData["StudentCode"])
       ->where("attendedDay",$inputData["attendedDay"])
       ->first();

       if($data){
           $data->update(["Status"=>$inputData["Status"],
           "attendedDay"=>$inputData["attendedDay"],
           "teacherComments"=>$inputData["comment"]
        ]);
       }else{
           $data=studentsAttendance::create([
            "StudentCode"=>$inputData["StudentCode"],
            "Status"=>$inputData["Status"],
            "attendedDay"=>$inputData["attendedDay"],
            "teacherComments"=>$inputData["comment"]
        
        ]);
       }
        return response()->json($data);

    }
public function getStudentsAttendance(Request $request){
    $inputData=$request->all();


    $this->middleware('auth:sanctum');
       
    $user_id=Auth::user()->id;
    $user=User::Join('head_teachers', 'users.id','=','head_teachers.UserId') 
    ->Join('schools','head_teachers.SchoolId' , '=','schools.id' )
    ->where('users.id','=',$user_id)
    ->get(['schools.SchoolCode']);



    $data = studentsAttendance::leftJoin('students', 'students.id', '=', 'students_attendances.StudentCode')
    ->select(
        DB::raw('students_attendances.attendedDay' ), 
        DB::raw('COUNT(DISTINCT students.id) as totalRegistered'), // Total registered students (distinct)
        DB::raw('SUM(CASE WHEN students.Gender = "Female" THEN 1 ELSE 0 END) as totalFemale'), // Total female students
        DB::raw('SUM(CASE WHEN students.Gender = "Male" THEN 1 ELSE 0 END) as totalMale'),// Total male students
        DB::raw('SUM(CASE WHEN students_attendances.Status = "Present" THEN 1 ELSE 0 END) as totalPresent'), // Total present students
        DB::raw('SUM(CASE WHEN students.Gender = "Female" AND students_attendances.Status = "Present" THEN 1 ELSE 0 END) as totalPresentFemale'), // Total present female students
        DB::raw('SUM(CASE WHEN students.Gender = "Male" AND students_attendances.Status = "Present" THEN 1 ELSE 0 END) as totalPresentMale'), // Total present male students
        
    )
    ->where('students.SchoolCode', '=', $user[0]["SchoolCode"])
    ->where('students_attendances.attendedDay', '>=',  $inputData['fromDate'])
    ->where('students_attendances.attendedDay', '<=',  $inputData['toDate'])
    ->groupBy('students_attendances.attendedDay')
    ->get();

    return response()->json($data);
}

public function allStudentsInClass(){

}

public function studentsAttendanceDetail ($id){
    $data = Student::join('school_classes', 'school_classes.id', '=', 'students.ClassLevel')
    ->join('students_attendances', 'students.id', '=', 'students_attendances.StudentCode')
    ->where('students_attendances.StudentCode', $id)
    ->get();
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