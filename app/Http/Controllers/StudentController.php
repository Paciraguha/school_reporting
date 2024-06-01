<?php

namespace App\Http\Controllers;
use App\Models\Student;
use App\Models\studentsAttendance;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data=Student::join('school_classes','school_classes.id','=','students.ClassLevel')
        ->where('students.SchoolCode','001')
        ->get(['students.id','students.SchoolCode','students.FirstName','students.LastName','students.Gender','students.StudentCode','school_classes.SchoolClass']);
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     * 
     */
    public function getAllSchoolClasses(){
        
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
       // return response()->json($inputData);
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
       //return response()->json($inputData);
        $data=studentsAttendance::create([
            "StudentCode"=>$inputData["Schoolcode"],
            "Status"=>$inputData["Status"],
            "attendedDay"=>$inputData["attendedDay"]
        
        ]);
        return response()->json($data);

    }
public function getStudentsAttendance(){

    $totalStudent=Student::where("SchoolCode",'=','001')->count();

    $totalStudentMale=Student::where("SchoolCode",'=','001')
                        ->where('Gender','Male')
                        ->count();

    $totalStudentFemale=Student::where("SchoolCode",'=','001')
                     ->where('Gender','Female')
                     ->count();

    $attendedtotal=studentsAttendance::join("students",'students.id','=','students_attendances.StudentCode')
                                        ->where('students.SchoolCode','=','001')
                                        ->where('students_attendances.Status','=','Present')
                                        ->count();

    $attendedFemale=studentsAttendance::join("students",'students.id','=','students_attendances.StudentCode')
    ->where('students.SchoolCode','=','001')
    ->where('students.Gender','=','Female')
    ->where('students_attendances.Status','=','Present')
    ->count();
    
    $attendedMale=studentsAttendance::join("students",'students.id','=','students_attendances.StudentCode')
    ->where('students.SchoolCode','=','001')
    ->where('students.Gender','=','Male')
    ->where('students_attendances.Status','=','Present')
    ->count();

     $total=[
        "totalRegistered"=>$totalStudent,
        "totalMale"=>$totalStudentMale,
        "totalFemale"=>$totalStudentMale,
        "attendedTotal"=>$attendedtotal,
        "attendedFemale"=>$attendedFemale,
        "attendedMale"=>$attendedMale,
        "attendancePercentage"=>($attendedtotal * 100/$totalStudent)
     ] ;  

    return response()->json($total);
    
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