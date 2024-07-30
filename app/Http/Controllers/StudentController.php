<?php

namespace App\Http\Controllers;
use App\Models\Student;
use App\Models\User;
use App\Models\studentsAttendance;
use App\Models\SchoolClass;
use App\Models\School;
use App\Models\Sector;
use App\Models\ClassLevel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\DB;
class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index()
    {
        //
        if (Auth::check()) {
            $loggeduser=Auth::user();
           
            if(isset($_GET['ClassId'])){
                $data=Student::join('school_classes','school_classes.id','=','students.ClassLevel')
                ->where('students.ClassLevel',$_GET['ClassId'])
                ->get(['students.id','students.SchoolCode','students.FirstName','students.LastName','students.Gender','students.StudentCode','school_classes.SchoolClass']);
                return response()->json($data);

            }else if($loggeduser['position']=="Teacher"){
                
                $user=User::Join('head_teachers', 'users.id','=','head_teachers.UserId') 
                ->Join('schools','head_teachers.SchoolId' , '=','schools.id' )
                ->Join('teacher_classes','teacher_classes.TeacherId' , '=','users.id' )
                ->where('users.id','=',$loggeduser["id"])
                ->get(['schools.SchoolCode','teacher_classes.ClassId']);
                
                $data=Student::join('school_classes','school_classes.id','=','students.ClassLevel')
                ->where('students.SchoolCode',$user[0]["SchoolCode"])
                ->where('students.ClassLevel',$user[0]["ClassId"])
                ->get(['students.id','students.SchoolCode','students.FirstName','students.LastName','students.Gender','students.StudentCode','school_classes.SchoolClass']);
                return response()->json($data);

            }else if($loggeduser['position']=="HeadTeacher" || $loggeduser['position']=="DOS"){
               
            $user=User::Join('head_teachers', 'users.id','=','head_teachers.UserId') 
            ->Join('schools','head_teachers.SchoolId' , '=','schools.id' )
            ->where('users.id','=',$loggeduser["id"])
            ->get(['schools.SchoolCode']);
             
            $data = Student::join('school_classes', 'school_classes.id', '=', 'students.ClassLevel')
            ->leftJoin('students_attendances', 'students.id', '=', 'students_attendances.StudentCode')
            ->where('students.SchoolCode', $user[0]["SchoolCode"])
            ->groupBy('students_attendances.StudentCode','students.id', 'students.FirstName', 'students.LastName', 'students.Gender', 'students.StudentCode', 'school_classes.SchoolClass','school_classes.id') // Add grouping by attendedDay
            ->select( 
                'students.id',
                'students.FirstName',  
                'students.LastName', 
                'students.Gender',
                'students.StudentCode',
                 'school_classes.SchoolClass',
                 'school_classes.id as class_id',
                // Include student's first name
                DB::raw('COUNT(students_attendances.StudentCode) as totalRegistered'),
                DB::raw('SUM(CASE WHEN students_attendances.Status = "Present" THEN 1 ELSE 0 END) as totalPresent'),
                DB::raw('SUM(CASE WHEN students_attendances.Status = "Absent" THEN 1 ELSE 0 END) as totalAbsent'),
            )
            
            ->get();
            return response()->json($data);
        }
        
        
        
        
     }else {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }
    }
 

    
    function checkIfStudentAttended(Request $request){
        $inputData=$request->all();
      //  return response()->json($tudents);
        $tudents=studentsAttendance::where('StudentCode',$inputData["studentCode"])
                                    ->where('attendedDay',$inputData["attendedDay"])
                                    ->first();
    
    
        return response()->json($tudents);
                
    }



    /**
     * Show the form for creating a new resource.
     * 
     */
    public function getAllStudentAttendanceScore(){
        if (Auth::check()) {
             
            $user_id=Auth::user()->id;
            $user=User::Join('head_teachers', 'users.id','=','head_teachers.UserId') 
            ->Join('schools','head_teachers.SchoolId' , '=','schools.id' )
            ->Join('teacher_classes','teacher_classes.TeacherId' , '=','users.id' )
            ->where('users.id','=',$user_id)
            ->get(['schools.SchoolCode','teacher_classes.ClassId']);

        
            $data = Student::join('school_classes', 'school_classes.id', '=', 'students.ClassLevel')
            ->join('students_attendances', 'students.id', '=', 'students_attendances.StudentCode')
            ->where('students.SchoolCode', $user[0]["SchoolCode"])
            ->where('students.ClassLevel',$user[0]["ClassId"])
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


   public function updatestudentinfo(Request $request){
    $inputData=$request->all();
    $data = Student::where('id', $inputData["student_id"])
       ->first();

       if($data){
           $data->update([
            "ClassLevel"=>$inputData["ClassLevel"],
            "FirstName"=>$inputData["FirstName"],
            "LastName"=>$inputData["LastName"],
            "Gender"=>$inputData["Gender"],
        ]);
    return response()->json($data);
   }

   }


   public function deletestudentinfo($id){
    $student = Student::find($id);
        if ($student) {
            $student->delete();
            return response()->json(["message" => "Student data is successfully deleted"]);
        } else {
            return response()->json(["message" => "Student not found"], 404);
        }
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
   
             $user_id=Auth::user()->id;
            $user=User::Join('head_teachers', 'users.id','=','head_teachers.UserId') 
            ->Join('schools','head_teachers.SchoolId' , '=','schools.id' )
            ->Join('teacher_classes','teacher_classes.TeacherId' , '=','users.id' )
            ->where('users.id','=',$user_id)
            ->get(['schools.SchoolCode','teacher_classes.ClassId']);

     

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
    ->where('students.ClassLevel',$user[0]["ClassId"])
    ->where('students_attendances.attendedDay', '>=',  $inputData['fromDate'])
    ->where('students_attendances.attendedDay', '<=',  $inputData['toDate'])
    ->groupBy('students_attendances.attendedDay')
    ->get();

    return response()->json($data);
}


public function getAllStudentAttendanceScoreInSchool($id){

     $user_id=Auth::user()->id;
            $user=User::Join('head_teachers', 'users.id','=','head_teachers.UserId') 
            ->Join('schools','head_teachers.SchoolId' , '=','schools.id' )
            ->where('users.id','=',$user_id)
            ->get(['schools.SchoolCode']);

           // return response()->json($user_id); 

            
           $data = Student::join('school_classes', 'school_classes.id', '=', 'students.ClassLevel')
           ->join('students_attendances', 'students.id', '=', 'students_attendances.StudentCode')
           ->where('students.SchoolCode', $user[0]["SchoolCode"])
           ->where('students.ClassLevel',$id)
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
}




public function getAllAttendanceByLevels(Request $request){

    if (Auth::check()) {

    $inputData=$request->all();
    if(Auth::user()->position==="SEO" || Auth::user()->position==="DEO"){  
        $user = School::where('id', '=', $inputData['schoolId'])
        ->get(['schools.SchoolCode']);
    
    // Ensure we have a valid SchoolCode
    if (!$user->isEmpty()) {
        $data1 = SchoolClass::where('SchoolCode', $user[0]["SchoolCode"])
            ->join("class_levels", 'class_levels.id', '=', 'school_classes.classLevel')
            ->select('school_classes.classLevel', 'class_levels.levels')
            ->groupBy('class_levels.id', 'class_levels.levels', 'school_classes.classLevel')
            ->get();
    
        $result = [];
    
        // Loop through each class level
        foreach ($data1 as $classLevel) {
            // Calculate totals for registered students, females, and males
            $totalStudents = Student::join('school_classes', 'students.ClassLevel', '=', 'school_classes.id')
               ->where('students.SchoolCode', $user[0]["SchoolCode"])
                ->where('school_classes.ClassLevel', $classLevel->classLevel)
                ->count();
    
            $totalFemales = Student::join('school_classes', 'students.ClassLevel', '=', 'school_classes.id')
                ->where('students.SchoolCode', $user[0]["SchoolCode"])
                ->where('school_classes.ClassLevel', $classLevel->classLevel)
                ->where('students.Gender', 'Female')
                ->count();
    
            $totalMales = Student::join('school_classes', 'students.ClassLevel', '=', 'school_classes.id')
                 ->where('students.SchoolCode', $user[0]["SchoolCode"])
                 ->where('school_classes.ClassLevel', $classLevel->classLevel)
                ->where('students.Gender', 'Male')
                ->count();
    
            $studentsAttendance = Student::leftJoin('school_classes', 'students.ClassLevel', '=', 'school_classes.id')
                ->leftJoin('students_attendances', 'students.id', '=', 'students_attendances.StudentCode')
                ->where('students.SchoolCode', $user[0]["SchoolCode"])
                ->where('school_classes.ClassLevel', $classLevel->classLevel)
                ->where(function ($query) use ($inputData) {
                    $query->whereBetween('students_attendances.attendedDay', [$inputData['fromDate'], $inputData['toDate']])
                          ->orWhereNull('students_attendances.attendedDay');
                })
                ->select(
                    DB::raw('students.ClassLevel'),
                    DB::raw('COALESCE(students_attendances.attendedDay, "No Attendance") as attendedDay'), // Handle null dates
                    DB::raw('COUNT(DISTINCT students.id) as totalRegistered'), // Total registered students (distinct)
                    DB::raw('SUM(CASE WHEN students.Gender = "Female" THEN 1 ELSE 0 END) as totalFemale'), // Total female students
                    DB::raw('SUM(CASE WHEN students.Gender = "Male" THEN 1 ELSE 0 END) as totalMale'), // Total male students
                    DB::raw('SUM(CASE WHEN students_attendances.Status = "Present" THEN 1 ELSE 0 END) as totalPresent'), // Total present students
                    DB::raw('SUM(CASE WHEN students.Gender = "Female" AND students_attendances.Status = "Present" THEN 1 ELSE 0 END) as totalPresentFemale'), // Total present female students
                    DB::raw('SUM(CASE WHEN students.Gender = "Male" AND students_attendances.Status = "Present" THEN 1 ELSE 0 END) as totalPresentMale') // Total present male students
                )
                ->groupBy('students.ClassLevel', 'students_attendances.attendedDay')
                ->get();
    
            // Create a map to ensure all dates within the range are included
            $dateRange = [];
            $currentDate = strtotime($inputData['fromDate']);
            $endDate = strtotime($inputData['toDate']);
            while ($currentDate <= $endDate) {
                $dateRange[date('Y-m-d', $currentDate)] = [
                    'ClassLevel' => $classLevel->classLevel,
                    'attendedDay' => date('Y-m-d', $currentDate),
                    'totalRegistered' => $totalStudents,
                    'totalFemale' => $totalFemales,
                    'totalMale' => $totalMales,
                    'totalPresent' => 0,
                    'totalPresentFemale' => 0,
                    'totalPresentMale' => 0,
                ];
                $currentDate = strtotime("+1 day", $currentDate);
            }
    
            // Transform the attendance data to include all dates and sum attendance
            foreach ($studentsAttendance as $attendance) {
                $attendedDay = $attendance->attendedDay;
                if ($attendedDay === "No Attendance") {
                    continue; // Skip if it's "No Attendance"
                }
                $dateRange[$attendedDay]['totalPresent'] += $attendance->totalPresent;
                $dateRange[$attendedDay]['totalPresentFemale'] += $attendance->totalPresentFemale;
                $dateRange[$attendedDay]['totalPresentMale'] += $attendance->totalPresentMale;
            }
    
            // Add the attendance data to the result array under the class level
            $result[] = [
                'classLevel' => $classLevel->classLevel,
                'levels' => $classLevel->levels,
                'studentsAttendance' => array_values($dateRange)
            ];
        }
    
        return response()->json($result);
    } else {
        return response()->json(['error' => 'School not found'], 404);
    }
    



        

    }else{

    
    $user_id=Auth::user()->id;
    $user=User::Join('head_teachers', 'users.id','=','head_teachers.UserId') 
    ->Join('schools','head_teachers.SchoolId' , '=','schools.id' )
    ->where('users.id','=',$user_id)
    ->get(['schools.SchoolCode']);

    $data1 = SchoolClass::where('SchoolCode', $user[0]["SchoolCode"])
        ->join("class_levels",'class_levels.id','=','school_classes.classLevel')
        ->select('school_classes.classLevel','class_levels.levels')
        ->groupBy('class_levels.id','class_levels.levels','school_classes.classLevel')
        ->get();
       
        $result = [];

        // Loop through each class level
        foreach ($data1 as $classLevel) {
                $studentsAttendance = Student::join('school_classes', 'students.ClassLevel', '=', 'school_classes.id')
                ->leftJoin('students_attendances', 'students.id', '=', 'students_attendances.StudentCode')
                ->where('students.SchoolCode', $user[0]["SchoolCode"])
                ->where('school_classes.ClassLevel', $classLevel->classLevel)
                ->select(
                    DB::raw('students.ClassLevel' ), 
                    DB::raw('school_classes.SchoolClass' ),
                    DB::raw('COUNT(DISTINCT students.id) as totalRegistered'), // Total registered students (distinct)
                    DB::raw('COUNT(DISTINCT CASE WHEN students.Gender = "Female" THEN students.id ELSE NULL END) as totalFemale'), // Total female students
                    DB::raw('COUNT(DISTINCT CASE WHEN students.Gender = "Male" THEN students.id ELSE NULL END) as totalMale'), // Total male students
                    DB::raw('SUM(CASE WHEN students_attendances.Status = "Present" AND students_attendances.attendedDay BETWEEN \'' . $inputData['fromDate'] . '\' AND \'' . $inputData['toDate'] . '\' THEN 1 ELSE 0 END) as totalPresent'), // Total present students
                    DB::raw('SUM(CASE WHEN students.Gender = "Female" AND students_attendances.Status = "Present" AND students_attendances.attendedDay BETWEEN \'' . $inputData['fromDate'] . '\' AND \'' . $inputData['toDate'] . '\' THEN 1 ELSE 0 END) as totalPresentFemale'), // Total present female students
                    DB::raw('SUM(CASE WHEN students.Gender = "Male" AND students_attendances.Status = "Present" AND students_attendances.attendedDay BETWEEN \'' . $inputData['fromDate'] . '\' AND \'' . $inputData['toDate'] . '\' THEN 1 ELSE 0 END) as totalPresentMale') // Total present male students
                ) 
               
               
                ->groupBy('students.ClassLevel','school_classes.SchoolClass')
                ->get();
            
    
            // Add the attendance data to the result array under the class level
            $result[] = [
                'classLevel' => $classLevel->classLevel,
                'levels' => $classLevel->levels,
                'studentsAttendance' => $studentsAttendance
            ];
        }

        return response()->json($result);
    }
    }else{

    }

    }


public function getAllAttendanceBySchool(Request $request){

    $inputData=$request->all();
    if(Auth::user()->position==="HeadTeacher" || Auth::user()->position==="DOS"){  
        
        $user_id=Auth::user()->id;
        $user=User::Join('head_teachers', 'users.id','=','head_teachers.UserId') 
        ->Join('schools','head_teachers.SchoolId' , '=','schools.id' )
        ->where('users.id','=',$user_id)
        ->get(['schools.SchoolCode']);
    
        $data1 = SchoolClass::where('SchoolCode', $user[0]["SchoolCode"])
            ->join("class_levels",'class_levels.id','=','school_classes.classLevel')
            ->select('school_classes.classLevel','class_levels.levels')
            ->groupBy('class_levels.id','class_levels.levels','school_classes.classLevel')
            ->get();


        $result = [];
    
        // Loop through each class level
        foreach ($data1 as $classLevel) {
            // Calculate totals for registered students, females, and males
            $totalStudents = Student::join('school_classes', 'students.ClassLevel', '=', 'school_classes.id')
               ->where('students.SchoolCode', $user[0]["SchoolCode"])
                ->where('school_classes.ClassLevel', $classLevel->classLevel)
                ->count();
    
            $totalFemales = Student::join('school_classes', 'students.ClassLevel', '=', 'school_classes.id')
                ->where('students.SchoolCode', $user[0]["SchoolCode"])
                ->where('school_classes.ClassLevel', $classLevel->classLevel)
                ->where('students.Gender', 'Female')
                ->count();
    
            $totalMales = Student::join('school_classes', 'students.ClassLevel', '=', 'school_classes.id')
                 ->where('students.SchoolCode', $user[0]["SchoolCode"])
                 ->where('school_classes.ClassLevel', $classLevel->classLevel)
                ->where('students.Gender', 'Male')
                ->count();
    
            $studentsAttendance = Student::leftJoin('school_classes', 'students.ClassLevel', '=', 'school_classes.id')
                ->leftJoin('students_attendances', 'students.id', '=', 'students_attendances.StudentCode')
                ->where('students.SchoolCode', $user[0]["SchoolCode"])
                ->where('school_classes.ClassLevel', $classLevel->classLevel)
                ->where(function ($query) use ($inputData) {
                    $query->whereBetween('students_attendances.attendedDay', [$inputData['fromDate'], $inputData['toDate']])
                          ->orWhereNull('students_attendances.attendedDay');
                })
                ->select(
                    DB::raw('students.ClassLevel'),
                    DB::raw('COALESCE(students_attendances.attendedDay, "No Attendance") as attendedDay'), // Handle null dates
                    DB::raw('COUNT(DISTINCT students.id) as totalRegistered'), // Total registered students (distinct)
                    DB::raw('SUM(CASE WHEN students.Gender = "Female" THEN 1 ELSE 0 END) as totalFemale'), // Total female students
                    DB::raw('SUM(CASE WHEN students.Gender = "Male" THEN 1 ELSE 0 END) as totalMale'), // Total male students
                    DB::raw('SUM(CASE WHEN students_attendances.Status = "Present" THEN 1 ELSE 0 END) as totalPresent'), // Total present students
                    DB::raw('SUM(CASE WHEN students.Gender = "Female" AND students_attendances.Status = "Present" THEN 1 ELSE 0 END) as totalPresentFemale'), // Total present female students
                    DB::raw('SUM(CASE WHEN students.Gender = "Male" AND students_attendances.Status = "Present" THEN 1 ELSE 0 END) as totalPresentMale') // Total present male students
                )
                ->groupBy('students.ClassLevel', 'students_attendances.attendedDay')
                ->get();
    
            // Create a map to ensure all dates within the range are included
            $dateRange = [];
            $currentDate = strtotime($inputData['fromDate']);
            $endDate = strtotime($inputData['toDate']);
            while ($currentDate <= $endDate) {
                $dateRange[date('Y-m-d', $currentDate)] = [
                    'ClassLevel' => $classLevel->classLevel,
                    'attendedDay' => date('Y-m-d', $currentDate),
                    'totalRegistered' => $totalStudents,
                    'totalFemale' => $totalFemales,
                    'totalMale' => $totalMales,
                    'totalPresent' => 0,
                    'totalPresentFemale' => 0,
                    'totalPresentMale' => 0,
                ];
                $currentDate = strtotime("+1 day", $currentDate);
            }
    
            // Transform the attendance data to include all dates and sum attendance
            foreach ($studentsAttendance as $attendance) {
                $attendedDay = $attendance->attendedDay;
                if ($attendedDay === "No Attendance") {
                    continue; // Skip if it's "No Attendance"
                }
                $dateRange[$attendedDay]['totalPresent'] += $attendance->totalPresent;
                $dateRange[$attendedDay]['totalPresentFemale'] += $attendance->totalPresentFemale;
                $dateRange[$attendedDay]['totalPresentMale'] += $attendance->totalPresentMale;
            }
    
            // Add the attendance data to the result array under the class level
            $result[] = [
                'classLevel' => $classLevel->classLevel,
                'levels' => $classLevel->levels,
                'studentsAttendance' => array_values($dateRange)
            ];
        }
    
        return response()->json($result);
    } else {
        return response()->json(['error' => 'School not found'], 404);
    }
    
    }










public function studentsAttendanceDetail ($id){
    $data = Student::join('school_classes', 'school_classes.id', '=', 'students.ClassLevel')
    ->join('students_attendances', 'students.id', '=', 'students_attendances.StudentCode')
    ->where('students_attendances.StudentCode', $id)
    ->get(["students.ClassLevel","students.FirstName","students.Gender","students.LastName","school_classes.SchoolClass","students.SchoolCode",
    "students_attendances.Status","students.StudentCode","students_attendances.attendedDay","school_classes.classLevel","students.id","students_attendances.teacherComments","students_attendances.updated_at"]);
    return response()->json($data);
}




/* SEO students code ------------------------------------------------------------------------------------------------------------------------------------------ */

public function SEO_AllStudents(){
    $user_id=Auth::user()->id;
    $user=User::Join('sector_leaders', 'users.id','=','sector_leaders.UserId') 
    ->Join('sectors','sectors.id' , '=','sector_leaders.SectorId')
    ->where('users.id','=',$user_id)
    ->get(['sectors.id']);

    //return response()->json($user[0]["id"]); 
    
   $data = Student::join('school_classes', 'school_classes.id', '=', 'students.ClassLevel')
   ->join('students_attendances', 'students.id', '=', 'students_attendances.StudentCode')
   ->join('schools','schools.SchoolCode','=','students.SchoolCode')
   ->join("sectors",'sectors.SectorCode','=','schools.SectorCode')
   ->where('sectors.id', $user[0]["id"])
   ->groupBy('students_attendances.StudentCode','students.id', 'students.FirstName', 'students.LastName', 'students.Gender', 'students.StudentCode', 'schools.SchoolCode', 'schools.SchoolName','school_classes.SchoolClass') // Add grouping by attendedDay
   ->select( 
       'students.id',
       'students.FirstName',  
       'students.LastName', 
       'students.Gender',
       'students.StudentCode',
       'school_classes.SchoolClass',
       'schools.SchoolCode', 
       'schools.SchoolName',
       // Include student's first name
       DB::raw('COUNT(students_attendances.StudentCode) as totalRegistered'),
       DB::raw('SUM(CASE WHEN students_attendances.Status = "Present" THEN 1 ELSE 0 END) as totalPresent'),
       DB::raw('SUM(CASE WHEN students_attendances.Status = "Absent" THEN 1 ELSE 0 END) as totalAbsent'),
   )
   
   ->get();
   return response()->json($data);

}




 public function SEO_AllStudentsBySchool($id){
  
   $data = Student::join('school_classes', 'school_classes.id', '=', 'students.ClassLevel')
   ->join('students_attendances', 'students.id', '=', 'students_attendances.StudentCode')
   ->join('schools','schools.SchoolCode','=','students.SchoolCode')
   ->where('schools.id', $id)
   ->groupBy('students_attendances.StudentCode','students.id', 'students.FirstName', 'students.LastName', 'students.Gender', 'students.StudentCode', 'schools.SchoolCode', 'schools.SchoolName','school_classes.SchoolClass') // Add grouping by attendedDay
   ->select( 
       'students.id',
       'students.FirstName',  
       'students.LastName', 
       'students.Gender',
       'students.StudentCode',
       'school_classes.SchoolClass',
       'schools.SchoolCode', 
       'schools.SchoolName',
       // Include student's first name
       DB::raw('COUNT(students_attendances.StudentCode) as totalRegistered'),
       DB::raw('SUM(CASE WHEN students_attendances.Status = "Present" THEN 1 ELSE 0 END) as totalPresent'),
       DB::raw('SUM(CASE WHEN students_attendances.Status = "Absent" THEN 1 ELSE 0 END) as totalAbsent'),
   )
   
   ->get();
   return response()->json($data);

 }

 public function SEO_SectorAttendance(Request $request){
    if (Auth::check()) {

    $inputData=$request->all();
    if(Auth::user()->position==="SEO"){  

        $user_id=Auth::user()->id;
        $sector=User::Join('sector_leaders', 'users.id','=','sector_leaders.UserId') 
        ->Join('sectors','sectors.id' , '=','sector_leaders.SectorId')
        ->where('users.id','=',$user_id)
        ->get(['sectors.id','sectors.SectorCode']);
    
    $data1 = ClassLevel::all();

    $result = [];

    foreach ($data1 as $classLevel) {
    
        $studentsAttendance = Student::join('school_classes', 'students.ClassLevel', '=', 'school_classes.id')
            ->join('schools', 'schools.SchoolCode', '=', 'school_classes.SchoolCode')
            ->leftJoin('students_attendances', 'students.id', '=', 'students_attendances.StudentCode')
            ->where('schools.SectorCode', $sector[0]['SectorCode'])
            ->where('school_classes.ClassLevel', $classLevel->id)
            ->select(
                'schools.SchoolCode',
                'schools.SchoolName',
                'school_classes.ClassLevel',
                DB::raw('COUNT(DISTINCT students.id) as totalRegistered'), // Total registered students (distinct)
                DB::raw('COUNT(DISTINCT CASE WHEN students.Gender = "Female" THEN students.id ELSE NULL END) as totalFemale'), // Total female students
                DB::raw('COUNT(DISTINCT CASE WHEN students.Gender = "Male" THEN students.id ELSE NULL END) as totalMale'), // Total male students
                DB::raw('SUM(CASE WHEN students_attendances.Status = "Present" AND students_attendances.attendedDay BETWEEN \'' . $inputData['fromDate'] . '\' AND \'' . $inputData['toDate'] . '\' THEN 1 ELSE 0 END) as totalPresent'), // Total present students
                DB::raw('SUM(CASE WHEN students.Gender = "Female" AND students_attendances.Status = "Present" AND students_attendances.attendedDay BETWEEN \'' . $inputData['fromDate'] . '\' AND \'' . $inputData['toDate'] . '\' THEN 1 ELSE 0 END) as totalPresentFemale'), // Total present female students
                DB::raw('SUM(CASE WHEN students.Gender = "Male" AND students_attendances.Status = "Present" AND students_attendances.attendedDay BETWEEN \'' . $inputData['fromDate'] . '\' AND \'' . $inputData['toDate'] . '\' THEN 1 ELSE 0 END) as totalPresentMale') // Total present male students
            )
            ->groupBy('schools.SchoolCode', 'schools.SchoolName', 'school_classes.ClassLevel')
            ->get();

        // Add the attendance data to the result array under the class level
        $result[] = [
            'classLevel' => $classLevel->classLevel,
            'levels' => $classLevel->levels,
            'studentsAttendance' => $studentsAttendance
        ];
    }

    return response()->json($result);

                
            }
            }else{
                return response()->json(['error' => 'Unauthenticated'], 401);
            }
 }





 public function DEO_DistrictAttendance(Request $request){
    if (Auth::check()) {
    $inputData=$request->all();
    if(Auth::user()->position==="DEO"){  

    $data1 = ClassLevel::all();

    $result = [];

    foreach ($data1 as $classLevel) {
    
        $studentsAttendance = Student::join('school_classes', 'students.ClassLevel', '=', 'school_classes.id')
            ->join('schools', 'schools.SchoolCode', '=', 'school_classes.SchoolCode')
            ->leftJoin('students_attendances', 'students.id', '=', 'students_attendances.StudentCode')
            ->leftJoin('sectors','schools.SectorCode','=', 'sectors.SectorCode' )
            ->where('school_classes.ClassLevel', $classLevel->id)
            ->select(
                'sectors.SectorCode',
                'sectors.SectorName',
                'school_classes.ClassLevel',
                DB::raw('COUNT(DISTINCT students.id) as totalRegistered'), // Total registered students (distinct)
                DB::raw('COUNT(DISTINCT CASE WHEN students.Gender = "Female" THEN students.id ELSE NULL END) as totalFemale'), // Total female students
                DB::raw('COUNT(DISTINCT CASE WHEN students.Gender = "Male" THEN students.id ELSE NULL END) as totalMale'), // Total male students
                DB::raw('SUM(CASE WHEN students_attendances.Status = "Present" AND students_attendances.attendedDay BETWEEN \'' . $inputData['fromDate'] . '\' AND \'' . $inputData['toDate'] . '\' THEN 1 ELSE 0 END) as totalPresent'), // Total present students
                DB::raw('SUM(CASE WHEN students.Gender = "Female" AND students_attendances.Status = "Present" AND students_attendances.attendedDay BETWEEN \'' . $inputData['fromDate'] . '\' AND \'' . $inputData['toDate'] . '\' THEN 1 ELSE 0 END) as totalPresentFemale'), // Total present female students
                DB::raw('SUM(CASE WHEN students.Gender = "Male" AND students_attendances.Status = "Present" AND students_attendances.attendedDay BETWEEN \'' . $inputData['fromDate'] . '\' AND \'' . $inputData['toDate'] . '\' THEN 1 ELSE 0 END) as totalPresentMale') // Total present male students
            )
            ->groupBy('sectors.SectorCode', 'sectors.SectorName', 'school_classes.ClassLevel')
            ->get();

        // Add the attendance data to the result array under the class level
        $result[] = [
            'classLevel' => $classLevel->classLevel,
            'levels' => $classLevel->levels,
            'studentsAttendance' => $studentsAttendance
        ];
    }

    return response()->json($result);

                
            }
            }else{
                return response()->json(['error' => 'Unauthenticated'], 401);
            }
 }


 public function DEO_SectorAttendanceByDate(Request $request,$id){

    if (Auth::check()) {

        $inputData=$request->all();
        if(Auth::user()->position==="DEO"){  

  
    $data1 = ClassLevel::all();

    $result = [];

    foreach ($data1 as $classLevel) {
    
        $studentsAttendance = Student::join('school_classes', 'students.ClassLevel', '=', 'school_classes.id')
            ->join('schools', 'schools.SchoolCode', '=', 'school_classes.SchoolCode')
            ->leftJoin('students_attendances', 'students.id', '=', 'students_attendances.StudentCode')
            ->where('schools.SectorCode', $id)
            ->where('school_classes.ClassLevel', $classLevel->id)
            ->select(
                'schools.SchoolCode',
                'schools.SchoolName',
                'school_classes.ClassLevel',
                DB::raw('COUNT(DISTINCT students.id) as totalRegistered'), // Total registered students (distinct)
                DB::raw('COUNT(DISTINCT CASE WHEN students.Gender = "Female" THEN students.id ELSE NULL END) as totalFemale'), // Total female students
                DB::raw('COUNT(DISTINCT CASE WHEN students.Gender = "Male" THEN students.id ELSE NULL END) as totalMale'), // Total male students
                DB::raw('SUM(CASE WHEN students_attendances.Status = "Present" AND students_attendances.attendedDay BETWEEN \'' . $inputData['fromDate'] . '\' AND \'' . $inputData['toDate'] . '\' THEN 1 ELSE 0 END) as totalPresent'), // Total present students
                DB::raw('SUM(CASE WHEN students.Gender = "Female" AND students_attendances.Status = "Present" AND students_attendances.attendedDay BETWEEN \'' . $inputData['fromDate'] . '\' AND \'' . $inputData['toDate'] . '\' THEN 1 ELSE 0 END) as totalPresentFemale'), // Total present female students
                DB::raw('SUM(CASE WHEN students.Gender = "Male" AND students_attendances.Status = "Present" AND students_attendances.attendedDay BETWEEN \'' . $inputData['fromDate'] . '\' AND \'' . $inputData['toDate'] . '\' THEN 1 ELSE 0 END) as totalPresentMale') // Total present male students
            )
            ->groupBy('schools.SchoolCode', 'schools.SchoolName', 'school_classes.ClassLevel')
            ->get();

        // Add the attendance data to the result array under the class level
        $result[] = [
            'classLevel' => $classLevel->classLevel,
            'levels' => $classLevel->levels,
            'studentsAttendance' => $studentsAttendance
        ];
    }

    return response()->json($result);
                
            }
            }else{
                return response()->json(['error' => 'Unauthenticated'], 401);
            }
 }




 public function DEO_SectorAttendance(Request $request,$id){

    if (Auth::check()) {

        $inputData=$request->all();
        if(Auth::user()->position==="DEO"){  
            
    $data1 = ClassLevel::all();
    $result = [];
   
    foreach ($data1 as $classLevel) {
            
            $totalStudents = Student::join('school_classes', 'students.ClassLevel', '=', 'school_classes.id')
            ->join('schools', 'schools.SchoolCode', '=', 'school_classes.SchoolCode')
            ->where('schools.SectorCode', $id)
             ->where('school_classes.ClassLevel', $classLevel->id)
             ->count();
 
         $totalFemales = Student::join('school_classes', 'students.ClassLevel', '=', 'school_classes.id')
             ->join('schools', 'schools.SchoolCode', '=', 'school_classes.SchoolCode')
             ->where('schools.SectorCode', $id)
             ->where('school_classes.ClassLevel', $classLevel->id)
             ->where('students.Gender', 'Female')
             ->count();
 
         $totalMales = Student::join('school_classes', 'students.ClassLevel', '=', 'school_classes.id')
               ->join('schools', 'schools.SchoolCode', '=', 'school_classes.SchoolCode')
              ->where('schools.SectorCode', $id)
              ->where('school_classes.ClassLevel', $classLevel->id)
             ->where('students.Gender', 'Male')
             ->count();
 

    
        $studentsAttendance = Student::join('school_classes', 'students.ClassLevel', '=', 'school_classes.id')
            ->join('schools', 'schools.SchoolCode', '=', 'school_classes.SchoolCode')
            ->leftJoin('students_attendances', 'students.id', '=', 'students_attendances.StudentCode')
            ->where('schools.SectorCode', $id)
            ->where('school_classes.ClassLevel', $classLevel->id)
                ->where(function ($query) use ($inputData) {
                    $query->whereBetween('students_attendances.attendedDay', [$inputData['fromDate'], $inputData['toDate']])
                          ->orWhereNull('students_attendances.attendedDay');
                })
                ->select(
                    DB::raw('students.ClassLevel'),
                    DB::raw('COALESCE(students_attendances.attendedDay, "No Attendance") as attendedDay'), // Handle null dates
                    DB::raw('COUNT(DISTINCT students.id) as totalRegistered'), // Total registered students (distinct)
                    DB::raw('SUM(CASE WHEN students.Gender = "Female" THEN 1 ELSE 0 END) as totalFemale'), // Total female students
                    DB::raw('SUM(CASE WHEN students.Gender = "Male" THEN 1 ELSE 0 END) as totalMale'), // Total male students
                    DB::raw('SUM(CASE WHEN students_attendances.Status = "Present" THEN 1 ELSE 0 END) as totalPresent'), // Total present students
                    DB::raw('SUM(CASE WHEN students.Gender = "Female" AND students_attendances.Status = "Present" THEN 1 ELSE 0 END) as totalPresentFemale'), // Total present female students
                    DB::raw('SUM(CASE WHEN students.Gender = "Male" AND students_attendances.Status = "Present" THEN 1 ELSE 0 END) as totalPresentMale') // Total present male students
                )
                ->groupBy('students.ClassLevel', 'students_attendances.attendedDay')
                ->get();
    
            // Create a map to ensure all dates within the range are included
            $dateRange = [];
            $currentDate = strtotime($inputData['fromDate']);
            $endDate = strtotime($inputData['toDate']);
            while ($currentDate <= $endDate) {
                $dateRange[date('Y-m-d', $currentDate)] = [
                    'ClassLevel' => $classLevel->classLevel,
                    'attendedDay' => date('Y-m-d', $currentDate),
                    'totalRegistered' => $totalStudents,
                    'totalFemale' => $totalFemales,
                    'totalMale' => $totalMales,
                    'totalPresent' => 0,
                    'totalPresentFemale' => 0,
                    'totalPresentMale' => 0,
                ];
                $currentDate = strtotime("+1 day", $currentDate);
            }
    
            // Transform the attendance data to include all dates and sum attendance
            foreach ($studentsAttendance as $attendance) {
                $attendedDay = $attendance->attendedDay;
                if ($attendedDay === "No Attendance") {
                    continue; // Skip if it's "No Attendance"
                }
                $dateRange[$attendedDay]['totalPresent'] += $attendance->totalPresent;
                $dateRange[$attendedDay]['totalPresentFemale'] += $attendance->totalPresentFemale;
                $dateRange[$attendedDay]['totalPresentMale'] += $attendance->totalPresentMale;
            }
    
            // Add the attendance data to the result array under the class level
            $result[] = [
                'classLevel' => $classLevel->classLevel,
                'levels' => $classLevel->levels,
                'studentsAttendance' => array_values($dateRange)
            ];
        }
    
        return response()->json($result);
    } 

            }else{
                return response()->json(['error' => 'Unauthenticated'], 401);
            }
 }
    /**
     * Store a newly created resource in storage.
     */

     public function DEO_AllStudents(Request $request){
       if(isset($request['sectorCode'])) {
        $data = Student::join('school_classes', 'school_classes.id', '=', 'students.ClassLevel')
       ->leftJoin('students_attendances', 'students.id', '=', 'students_attendances.StudentCode')
       ->join('schools','schools.SchoolCode','=','students.SchoolCode')
       ->join("sectors",'sectors.SectorCode','=','schools.SectorCode')
       ->where('sectors.SectorCode',$request['sectorCode'])
       ->groupBy('students_attendances.StudentCode','students.id', 'students.FirstName', 'students.LastName', 'students.Gender', 'students.StudentCode', 'schools.SchoolCode', 'schools.SchoolName','school_classes.SchoolClass','sectors.SectorName','sectors.SectorCode') // Add grouping by attendedDay
       ->select( 
           'students.id',
           'students.FirstName',  
           'students.LastName', 
           'students.Gender',
           'students.StudentCode',
           'school_classes.SchoolClass',
           'schools.SchoolCode', 
           'schools.SchoolName',
           'sectors.SectorName',
           'sectors.SectorCode',
           // Include student's first name
           DB::raw('COUNT(students_attendances.StudentCode) as totalRegistered'),
           DB::raw('SUM(CASE WHEN students_attendances.Status = "Present" THEN 1 ELSE 0 END) as totalPresent'),
           DB::raw('SUM(CASE WHEN students_attendances.Status = "Absent" THEN 1 ELSE 0 END) as totalAbsent'),
       )
       
       ->get();
       return response()->json($data);
        return response()->json( $request['sectorCode']);
       }else{
       $data = Student::join('school_classes', 'school_classes.id', '=', 'students.ClassLevel')
       ->leftJoin('students_attendances', 'students.id', '=', 'students_attendances.StudentCode')
       ->join('schools','schools.SchoolCode','=','students.SchoolCode')
       ->join("sectors",'sectors.SectorCode','=','schools.SectorCode')
       ->groupBy('students_attendances.StudentCode','students.id', 'students.FirstName', 'students.LastName', 'students.Gender', 'students.StudentCode', 'schools.SchoolCode', 'schools.SchoolName','school_classes.SchoolClass','sectors.SectorName','sectors.SectorCode') // Add grouping by attendedDay
       ->select( 
           'students.id',
           'students.FirstName',  
           'students.LastName', 
           'students.Gender',
           'students.StudentCode',
           'school_classes.SchoolClass',
           'schools.SchoolCode', 
           'schools.SchoolName',
           'sectors.SectorName',
           'sectors.SectorCode',
           // Include student's first name
           DB::raw('COUNT(students_attendances.StudentCode) as totalRegistered'),
           DB::raw('SUM(CASE WHEN students_attendances.Status = "Present" THEN 1 ELSE 0 END) as totalPresent'),
           DB::raw('SUM(CASE WHEN students_attendances.Status = "Absent" THEN 1 ELSE 0 END) as totalAbsent'),
       )
       
       ->get();
       return response()->json($data);

     }
    }



public function DEO_StudentAttendance(Request $request){

    if (Auth::check()) {
        $inputData=$request->all();
        if(Auth::user()->position==="DEO"){  
    
        $data1 = ClassLevel::all();
    
        $result = [];
        foreach ($data1 as $classLevel) {
     
        // Calculate totals for registered students, females, and males
        $totalStudents = Student::join('school_classes', 'students.ClassLevel', '=', 'school_classes.id')
            ->where('school_classes.ClassLevel', $classLevel->id)
            ->count();

        $totalFemales = Student::join('school_classes', 'students.ClassLevel', '=', 'school_classes.id')
            ->where('school_classes.ClassLevel', $classLevel->id)
            ->where('students.Gender', 'Female')
            ->count();

        $totalMales = Student::join('school_classes', 'students.ClassLevel', '=', 'school_classes.id')
             ->where('school_classes.ClassLevel', $classLevel->id)
            ->where('students.Gender', 'Male')
            ->count();

               
            $studentsAttendance = Student::join('school_classes', 'students.ClassLevel', '=', 'school_classes.id')
                ->join('schools', 'schools.SchoolCode', '=', 'school_classes.SchoolCode')
                ->leftJoin('students_attendances', 'students.id', '=', 'students_attendances.StudentCode')
                ->leftJoin('sectors','schools.SectorCode','=', 'sectors.SectorCode' )
                ->where('school_classes.ClassLevel', $classLevel->id)
                ->where(function ($query) use ($inputData) {
                    $query->whereBetween('students_attendances.attendedDay', [$inputData['fromDate'], $inputData['toDate']])
                        ->orWhereNull('students_attendances.attendedDay');
                })
                ->select(
                DB::raw('students.ClassLevel'),
                DB::raw('COALESCE(students_attendances.attendedDay, "No Attendance") as attendedDay'), // Handle null dates
                DB::raw('COUNT(DISTINCT students.id) as totalRegistered'), // Total registered students (distinct)
                DB::raw('SUM(CASE WHEN students.Gender = "Female" THEN 1 ELSE 0 END) as totalFemale'), // Total female students
                DB::raw('SUM(CASE WHEN students.Gender = "Male" THEN 1 ELSE 0 END) as totalMale'), // Total male students
                DB::raw('SUM(CASE WHEN students_attendances.Status = "Present" THEN 1 ELSE 0 END) as totalPresent'), // Total present students
                DB::raw('SUM(CASE WHEN students.Gender = "Female" AND students_attendances.Status = "Present" THEN 1 ELSE 0 END) as totalPresentFemale'), // Total present female students
                DB::raw('SUM(CASE WHEN students.Gender = "Male" AND students_attendances.Status = "Present" THEN 1 ELSE 0 END) as totalPresentMale') // Total present male students
            )
            ->groupBy('students.ClassLevel', 'students_attendances.attendedDay')
            ->get();

        // Create a map to ensure all dates within the range are included
        $dateRange = [];
        $currentDate = strtotime($inputData['fromDate']);
        $endDate = strtotime($inputData['toDate']);
        while ($currentDate <= $endDate) {
            $dateRange[date('Y-m-d', $currentDate)] = [
                'ClassLevel' => $classLevel->classLevel,
                'attendedDay' => date('Y-m-d', $currentDate),
                'totalRegistered' => $totalStudents,
                'totalFemale' => $totalFemales,
                'totalMale' => $totalMales,
                'totalPresent' => 0,
                'totalPresentFemale' => 0,
                'totalPresentMale' => 0,
            ];
            $currentDate = strtotime("+1 day", $currentDate);
        }

        // Transform the attendance data to include all dates and sum attendance
        foreach ($studentsAttendance as $attendance) {
            $attendedDay = $attendance->attendedDay;
            if ($attendedDay === "No Attendance") {
                continue; // Skip if it's "No Attendance"
            }
            $dateRange[$attendedDay]['totalPresent'] += $attendance->totalPresent;
            $dateRange[$attendedDay]['totalPresentFemale'] += $attendance->totalPresentFemale;
            $dateRange[$attendedDay]['totalPresentMale'] += $attendance->totalPresentMale;
        }

        // Add the attendance data to the result array under the class level
        $result[] = [
            'classLevel' => $classLevel->classLevel,
            'levels' => $classLevel->levels,
            'studentsAttendance' => array_values($dateRange)
        ];
    }

        return response()->json($result);  
            }
   
     }

    }



public function SEO_StudentAttendance(Request $request){

    if (Auth::check()) {
        $inputData=$request->all();
        if(Auth::user()->position==="SEO"){  

            $user_id=Auth::user()->id;
            $sector=User::Join('sector_leaders', 'users.id','=','sector_leaders.UserId') 
            ->Join('sectors','sectors.id' , '=','sector_leaders.SectorId')
            ->where('users.id','=',$user_id)
            ->get(['sectors.id','sectors.SectorCode']);
        
        
        $data1 = ClassLevel::all();
    
        $result = [];
        foreach ($data1 as $classLevel) {
     
        // Calculate totals for registered students, females, and males
        $totalStudents = Student::join('school_classes', 'students.ClassLevel', '=', 'school_classes.id')
            ->Join('schools','schools.SchoolCode','=','school_classes.SchoolCode')
            ->join('sectors','sectors.id','=','schools.SectorCode')
            ->where('sectors.id','=',$sector[0]['id'])
            ->where('school_classes.ClassLevel', $classLevel->id)
            ->count();

        $totalFemales = Student::join('school_classes', 'students.ClassLevel', '=', 'school_classes.id')
            ->Join('schools','schools.SchoolCode','=','school_classes.SchoolCode')
            ->join('sectors','sectors.id','=','schools.SectorCode')
            ->where('sectors.id','=',$sector[0]['id'])
            ->where('school_classes.ClassLevel', $classLevel->id)
            ->where('students.Gender', 'Female')
            ->count();

        $totalMales = Student::join('school_classes', 'students.ClassLevel', '=', 'school_classes.id')
            ->Join('schools','schools.SchoolCode','=','school_classes.SchoolCode')
            ->join('sectors','sectors.id','=','schools.SectorCode')
            ->where('sectors.id','=',$sector[0]['id'])
             ->where('school_classes.ClassLevel', $classLevel->id)
            ->where('students.Gender', 'Male')
            ->count();

               
            $studentsAttendance = Student::join('school_classes', 'students.ClassLevel', '=', 'school_classes.id')
                ->join('schools', 'schools.SchoolCode', '=', 'school_classes.SchoolCode')
               // ->leftJoin('students_attendances', 'students.id', '=', 'students_attendances.StudentCode')
                ->join('sectors','schools.SectorCode','=', 'sectors.SectorCode' )
                ->Leftjoin('students_attendances', 'students.id', '=', 'students_attendances.StudentCode')
                ->where('sectors.id','=',$sector[0]['id'])
                ->where('school_classes.ClassLevel', $classLevel->id)
                ->where(function ($query) use ($inputData) {
                    $query->whereBetween('students_attendances.attendedDay', [$inputData['fromDate'], $inputData['toDate']])
                        ->orWhereNull('students_attendances.attendedDay');
                })
                ->select(
                DB::raw('school_classes.ClassLevel'),
                DB::raw('COALESCE(students_attendances.attendedDay, "No Attendance") as attendedDay'), // Handle null dates
                DB::raw('COUNT(DISTINCT students.id) as totalRegistered'), // Total registered students (distinct)
                DB::raw('SUM(CASE WHEN students.Gender = "Female" THEN 1 ELSE 0 END) as totalFemale'), // Total female students
                DB::raw('SUM(CASE WHEN students.Gender = "Male" THEN 1 ELSE 0 END) as totalMale'), // Total male students
                DB::raw('SUM(CASE WHEN students_attendances.Status = "Present" THEN 1 ELSE 0 END) as totalPresent'), // Total present students
                DB::raw('SUM(CASE WHEN students.Gender = "Female" AND students_attendances.Status = "Present" THEN 1 ELSE 0 END) as totalPresentFemale'), // Total present female students
                DB::raw('SUM(CASE WHEN students.Gender = "Male" AND students_attendances.Status = "Present" THEN 1 ELSE 0 END) as totalPresentMale') // Total present male students
            )
            ->groupBy('school_classes.ClassLevel', 'students_attendances.attendedDay')
            ->get();

        // Create a map to ensure all dates within the range are included
        $dateRange = [];
        $currentDate = strtotime($inputData['fromDate']);
        $endDate = strtotime($inputData['toDate']);
        while ($currentDate <= $endDate) {
            $dateRange[date('Y-m-d', $currentDate)] = [
                'ClassLevel' => $classLevel->classLevel,
                'attendedDay' => date('Y-m-d', $currentDate),
                'totalRegistered' => $totalStudents,
                'totalFemale' => $totalFemales,
                'totalMale' => $totalMales,
                'totalPresent' => 0,
                'totalPresentFemale' => 0,
                'totalPresentMale' => 0,
            ];
            $currentDate = strtotime("+1 day", $currentDate);
        }

        // Transform the attendance data to include all dates and sum attendance
        foreach ($studentsAttendance as $attendance) {
            $attendedDay = $attendance->attendedDay;
            if ($attendedDay === "No Attendance") {
                continue; // Skip if it's "No Attendance"
            }
            $dateRange[$attendedDay]['totalPresent'] += $attendance->totalPresent;
            $dateRange[$attendedDay]['totalPresentFemale'] += $attendance->totalPresentFemale;
            $dateRange[$attendedDay]['totalPresentMale'] += $attendance->totalPresentMale;
        }

        // Add the attendance data to the result array under the class level
        $result[] = [
            'classLevel' => $classLevel->classLevel,
            'levels' => $classLevel->levels,
            'studentsAttendance' => array_values($dateRange)
        ];
    }

        return response()->json($result);  
            }
   
     }

    }
}