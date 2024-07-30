<?php

namespace App\Http\Controllers;
use App\Models\Teacher;
use App\Models\User;
use App\Models\SchoolClass;
use App\Models\ClassLevel;
use App\Models\School;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TeacherController extends Controller
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
        // $inputData=$request->all();
        // $data=Teacher::create([
        //     "Schoolcode"=> $inputData["Schoolcode"],
        //     "position"=> $inputData["position"],
        //     "RepresentationClass"=> $inputData["RepresentationClass"],
        //     "FirstName"=> $inputData["FirstName"],
        //     "LastName"=> $inputData["LastName"],
        //     "email"=> $inputData["email"],
        //     "Telephone"=>  $inputData["Telephone"] 
        // ]);

        // return response()->json($data);
    }

    public function newAttendance(Request $request){
      
        $inputData=$request->all();

        $data = Teacher::where('teacherId', $inputData["teacherId"])
        ->where("attendedDay",$inputData["attendedDay"])
        ->first();
 
        if($data){
            $data->update(["status"=>$inputData["Status"],
            "attendedDay"=>$inputData["attendedDay"],
            "comments"=>$inputData["comment"]
         ]);
        }else{
            $data=Teacher::create([
             "teacherId"=>$inputData["teacherId"],
             "status"=>$inputData["Status"],
             "attendedDay"=>$inputData["attendedDay"],
             "comments"=>$inputData["comment"]
         
         ]);
        }
         return response()->json($data);
    }


public function checksteachersInAttendance(Request $request){
    $inputData=$request->all();
    //  return response()->json($tudents);
      $teachers=Teacher::where('teacherId',$inputData["teacherId"])
                                  ->where('attendedDay',$inputData["attendedDay"])
                                  ->first();
      return response()->json($teachers);
}


public function teacherAttendanceList(){
    
        if (Auth::check()) {
            $loggeduser=Auth::user();
             if($loggeduser['position']=="HeadTeacher" || $loggeduser['position']=="DOS"){
            
            $user=User::Join('head_teachers', 'users.id','=','head_teachers.UserId') 
            ->Join('schools','head_teachers.SchoolId' , '=','schools.id' )
            ->where('users.id','=',$loggeduser["id"])
            ->get(['schools.SchoolCode']);

          
            $data=User::Join('head_teachers', 'users.id','=','head_teachers.UserId')
            ->Join('class_levels','head_teachers.teachingLevel' , '=','class_levels.id')
             ->Join('schools','head_teachers.SchoolId','=','schools.id')
            //  ->join('teacher_classes','teacher_classes.TeacherId','=','users.id' )
            //  ->join('school_classes','teacher_classes.ClassId','=','school_classes.id')
            //  ->leftJoin('teachers','users.id','=','teachers.teacherId')
            ->where('schools.SchoolCode',$user[0]["SchoolCode"])
            //->where('attendedDay','=',$inputData['reportdate'])
            ->get(['users.id','users.created_at','users.firstName','users.lastName','users.email','users.Telephone','schools.SchoolName','class_levels.levels',
            'head_teachers.teachingLevel']);
            return response()->json($data);
        }
        
    
    }else {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }
}




public function teachersDailyAttendanceStatistic(Request $request){

    if (Auth::check()) {

    $inputData=$request->all();

    if(Auth::user()->position==="DEO"){
        
        $data1 = ClassLevel::all(); 

       /// return response()->json($data1);

        $result = [];
    
        foreach ($data1 as $classLevel) {
                $studentsAttendance = User::join('head_teachers','head_teachers.userId','=','users.id')
                ->join('schools','schools.id','=','head_teachers.SchoolId')
                ->join('sectors','sectors.SectorCode','=','schools.SectorCode')
                ->join('teacher_classes', 'teacher_classes.TeacherId', '=', 'users.id')
                ->join("school_classes",'school_classes.id','=','teacher_classes.ClassId')
                ->leftJoin('teachers', 'users.id', '=', 'teachers.teacherId')
               // ->where('sectors.id', '01')
                ->where('school_classes.ClassLevel', $classLevel->id)
                ->select(
                     'sectors.SectorCode',
                     'sectors.SectorName',
                     'school_classes.ClassLevel',
                    DB::raw('COUNT(DISTINCT users.id) as totalRegistered'), 
                    DB::raw('COUNT(DISTINCT CASE WHEN users.Gender = "Female" THEN users.id ELSE NULL END) as totalFemale'), 
                    DB::raw('COUNT(DISTINCT CASE WHEN users.Gender = "Male" THEN users.id ELSE NULL END) as totalMale'), 
                    DB::raw('SUM(CASE WHEN teachers.status = "Present" AND teachers.attendedDay BETWEEN \'' . $inputData['fromDate'] . '\' AND \'' . $inputData['toDate'] . '\' THEN 1 ELSE 0 END) as totalPresent'), 
                    DB::raw('SUM(CASE WHEN users.Gender = "Female" AND teachers.status = "Present" AND teachers.attendedDay BETWEEN \'' . $inputData['fromDate'] . '\' AND \'' . $inputData['toDate'] . '\' THEN 1 ELSE 0 END) as totalPresentFemale'), 
                    DB::raw('SUM(CASE WHEN users.Gender = "Male" AND teachers.status = "Present" AND teachers.attendedDay BETWEEN \'' . $inputData['fromDate'] . '\' AND \'' . $inputData['toDate'] . '\' THEN 1 ELSE 0 END) as totalPresentMale') 
                ) 
               
                ->groupBy('school_classes.ClassLevel','sectors.SectorCode','sectors.SectorName')
                ->get();
            
    
            // Add the attendance data to the result array under the class level
            $result[] = [
                'classLevel' => $classLevel->levels,
                'levels' => $classLevel->levels,
                'studentsAttendance' => $studentsAttendance
            ];
        }

        return response()->json($result);





    }else if(Auth::user()->position==="SEO"){  
      
        $user_id=Auth::user()->id;
        $user=User::Join('sector_leaders', 'users.id','=','sector_leaders.UserId') 
        ->Join('sectors','sectors.id' , '=','sector_leaders.SectorId')
        ->where('users.id','=',$user_id)
        ->get(['sectors.id']);

        //return response()->json($user);

    $data1 = SchoolClass::join("class_levels",'class_levels.id','=','school_classes.classLevel')
        ->select('school_classes.classLevel','class_levels.levels')
        ->groupBy('class_levels.id','class_levels.levels','school_classes.classLevel')
        ->get();
       
        $result = [];

        // Loop through each class level
        foreach ($data1 as $classLevel) {
                $studentsAttendance = User::join('head_teachers','head_teachers.userId','=','users.id')
                ->join('schools','schools.id','=','head_teachers.SchoolId')
                ->join('sectors','sectors.SectorCode','=','schools.SectorCode')
                ->join('teacher_classes', 'teacher_classes.TeacherId', '=', 'users.id')
                ->join("school_classes",'school_classes.id','=','teacher_classes.ClassId')
                ->leftJoin('teachers', 'users.id', '=', 'teachers.teacherId')
                ->where('sectors.id', $user[0]["id"])
                ->where('school_classes.ClassLevel', $classLevel->classLevel)
                ->select(
                    //DB::raw('school_classes.classLevel' ), 
                    DB::raw('schools.SchoolName' ),
                    DB::raw('COUNT(DISTINCT users.id) as totalRegistered'), 
                    DB::raw('COUNT(DISTINCT CASE WHEN users.Gender = "Female" THEN users.id ELSE NULL END) as totalFemale'), 
                    DB::raw('COUNT(DISTINCT CASE WHEN users.Gender = "Male" THEN users.id ELSE NULL END) as totalMale'), 
                    DB::raw('SUM(CASE WHEN teachers.status = "Present" AND teachers.attendedDay BETWEEN \'' . $inputData['fromDate'] . '\' AND \'' . $inputData['toDate'] . '\' THEN 1 ELSE 0 END) as totalPresent'), 
                    DB::raw('SUM(CASE WHEN users.Gender = "Female" AND teachers.status = "Present" AND teachers.attendedDay BETWEEN \'' . $inputData['fromDate'] . '\' AND \'' . $inputData['toDate'] . '\' THEN 1 ELSE 0 END) as totalPresentFemale'), 
                    DB::raw('SUM(CASE WHEN users.Gender = "Male" AND teachers.status = "Present" AND teachers.attendedDay BETWEEN \'' . $inputData['fromDate'] . '\' AND \'' . $inputData['toDate'] . '\' THEN 1 ELSE 0 END) as totalPresentMale') 
                ) 
               
                ->groupBy('school_classes.classLevel','schools.SchoolCode','schools.SchoolName')
                ->get();
            
    
            // Add the attendance data to the result array under the class level
            $result[] = [
                'classLevel' => $classLevel->classLevel,
                'levels' => $classLevel->levels,
                'studentsAttendance' => $studentsAttendance
            ];
        }

        return response()->json($result);
        

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
                $studentsAttendance = User::join('head_teachers','head_teachers.userId','=','users.id')
                ->join('teacher_classes', 'teacher_classes.TeacherId', '=', 'users.id')
                ->join("school_classes",'school_classes.id','=','teacher_classes.ClassId')
                ->leftJoin('teachers', 'users.id', '=', 'teachers.teacherId')
                ->where('school_classes.SchoolCode', $user[0]["SchoolCode"])
                ->where('school_classes.ClassLevel', $classLevel->classLevel)
                ->select(
                    DB::raw('school_classes.classLevel' ), 
                    DB::raw('school_classes.SchoolClass' ),
                    DB::raw('COUNT(DISTINCT users.id) as totalRegistered'), 
                    DB::raw('COUNT(DISTINCT CASE WHEN users.Gender = "Female" THEN users.id ELSE NULL END) as totalFemale'), 
                    DB::raw('COUNT(DISTINCT CASE WHEN users.Gender = "Male" THEN users.id ELSE NULL END) as totalMale'), 
                    DB::raw('SUM(CASE WHEN teachers.status = "Present" AND teachers.attendedDay BETWEEN \'' . $inputData['fromDate'] . '\' AND \'' . $inputData['toDate'] . '\' THEN 1 ELSE 0 END) as totalPresent'), 
                    DB::raw('SUM(CASE WHEN users.Gender = "Female" AND teachers.status = "Present" AND teachers.attendedDay BETWEEN \'' . $inputData['fromDate'] . '\' AND \'' . $inputData['toDate'] . '\' THEN 1 ELSE 0 END) as totalPresentFemale'), 
                    DB::raw('SUM(CASE WHEN users.Gender = "Male" AND teachers.status = "Present" AND teachers.attendedDay BETWEEN \'' . $inputData['fromDate'] . '\' AND \'' . $inputData['toDate'] . '\' THEN 1 ELSE 0 END) as totalPresentMale') 
                ) 
               
                ->groupBy('school_classes.classLevel','school_classes.SchoolClass')
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


    public function teacherAttendanceDetail($id){
        $data =User::join('head_teachers','head_teachers.userId','=','users.id')
        ->Join('class_levels','head_teachers.teachingLevel' , '=','class_levels.id')
        // ->join('teacher_classes', 'teacher_classes.TeacherId', '=', 'users.id')
        // ->join("school_classes",'school_classes.id','=','teacher_classes.ClassId')
        ->join('teachers', 'users.id', '=', 'teachers.teacherId')
        ->where('teachers.teacherId', $id)
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
    public function teacherAttendanceBySchool(Request $request)
    {
        $inputData = $request->all();
        //return response()->json($inputData);
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
                foreach ($data1 as $classLevel) {
                    // Calculate totals for registered students, females, and males
                    $totalTeachers = User::join('head_teachers','head_teachers.userId','=','users.id')
                        ->join('teacher_classes', 'teacher_classes.TeacherId', '=', 'users.id')
                        ->join("school_classes",'school_classes.id','=','teacher_classes.ClassId')
                        ->join("schools",'school_classes.SchoolCode','=','schools.SchoolCode')
                        ->where('schools.id', $inputData['schoolId'])
                        ->where('school_classes.ClassLevel', $classLevel->classLevel)
                       ->count();
            
              
            
                    $totalFemales = User::join('head_teachers','head_teachers.userId','=','users.id')
                            ->join('teacher_classes', 'teacher_classes.TeacherId', '=', 'users.id')
                            ->join("school_classes",'school_classes.id','=','teacher_classes.ClassId')
                            ->join("schools",'school_classes.SchoolCode','=','schools.SchoolCode')
                            ->where('schools.id', $inputData['schoolId'])
                            ->where('users.Gender', 'Female')
                            ->where('school_classes.ClassLevel', $classLevel->classLevel)
                        ->count();
                      
            
                    $totalMales =  User::join('head_teachers','head_teachers.userId','=','users.id')
                            ->join('teacher_classes', 'teacher_classes.TeacherId', '=', 'users.id')
                            ->join("school_classes",'school_classes.id','=','teacher_classes.ClassId')
                            ->join("schools",'school_classes.SchoolCode','=','schools.SchoolCode')
                            ->where('schools.id', $inputData['schoolId'])
                            ->where('users.Gender', 'Male')
                            ->where('school_classes.ClassLevel', $classLevel->classLevel)
                        ->count();
              
            
                    $studentsAttendance =User::join('head_teachers','head_teachers.userId','=','users.id')
                        ->join('teacher_classes', 'teacher_classes.TeacherId', '=', 'users.id')
                        ->join("school_classes",'school_classes.id','=','teacher_classes.ClassId')
                        ->leftJoin('teachers', 'users.id', '=', 'teachers.teacherId')
                        ->where('school_classes.SchoolCode', $user[0]["SchoolCode"])
                        ->where('school_classes.ClassLevel', $classLevel->classLevel)
        
                        ->where(function ($query) use ($inputData) {
                            $query->whereBetween('teachers.attendedDay', [$inputData['fromDate'], $inputData['toDate']])
                                  ->orWhereNull('teachers.attendedDay');
                        })
                        ->select(
                            DB::raw('school_classes.classLevel'),
                            DB::raw('COALESCE(teachers.attendedDay, "No Attendance") as attendedDay'), // Handle null dates
                            DB::raw('COUNT(DISTINCT users.id) as totalRegistered'), // Total registered students (distinct)
                            DB::raw('SUM(CASE WHEN users.Gender = "Female" THEN 1 ELSE 0 END) as totalFemale'), // Total female students
                            DB::raw('SUM(CASE WHEN users.Gender = "Male" THEN 1 ELSE 0 END) as totalMale'), // Total male students
                            DB::raw('SUM(CASE WHEN teachers.status = "Present" THEN 1 ELSE 0 END) as totalPresent'), // Total present students
                            DB::raw('SUM(CASE WHEN users.Gender = "Female" AND teachers.status = "Present" THEN 1 ELSE 0 END) as totalPresentFemale'), // Total present female students
                            DB::raw('SUM(CASE WHEN users.Gender = "Male" AND teachers.status = "Present" THEN 1 ELSE 0 END) as totalPresentMale') // Total present male students
                        )
                        ->groupBy('school_classes.ClassLevel', 'teachers.attendedDay')
                        ->get();
            
                    // Create a map to ensure all dates within the range are included
                    $dateRange = [];
                    $currentDate = strtotime($inputData['fromDate']);
                    $endDate = strtotime($inputData['toDate']);
                    while ($currentDate <= $endDate) {
                        $dateRange[date('Y-m-d', $currentDate)] = [
                            'ClassLevel' => $classLevel->classLevel,
                            'attendedDay' => date('Y-m-d', $currentDate),
                            'totalRegistered' => $totalTeachers,
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
                    $teachersAttendance = array_values($dateRange);
        
                    // Sort the attendance data by date in descending order
                    usort($teachersAttendance, function($a, $b) {
                        return strtotime($b['attendedDay']) - strtotime($a['attendedDay']);
                    });
        
                    $result[] = [
                        'classLevel' => $classLevel->classLevel,
                        'levels' => $classLevel->levels,
                        'TeachersAttendance' => $teachersAttendance
                    ];
                }
            
                return response()->json($result);
            } else {
                return response()->json(['error' => 'School not found'], 404);
            }
        }
    }















    public function schoolTeacherAttendance(Request $request)
    {
   
        
        $inputData = $request->all();
        //return response()->json($inputData);
       
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

           // return response()->json($data1);
                $result = [];
                foreach ($data1 as $classLevel) {
                    // Calculate totals for registered students, females, and males
                    $totalTeachers = User::join('head_teachers','head_teachers.userId','=','users.id')
                        // ->join('teacher_classes', 'teacher_classes.TeacherId', '=', 'users.id')
                        // ->join("school_classes",'school_classes.id','=','teacher_classes.ClassId')
                        ->join("schools",'head_teachers.SchoolId','=','schools.id')
                        ->Join('class_levels','head_teachers.teachingLevel' , '=','class_levels.id')
                        ->where('schools.SchoolCode', $user[0]["SchoolCode"])
                        ->where('class_levels.id', $classLevel->classLevel)
                       ->count();
            
              
            
                    $totalFemales = User::join('head_teachers','head_teachers.userId','=','users.id')
                            // ->join('teacher_classes', 'teacher_classes.TeacherId', '=', 'users.id')
                            // ->join("school_classes",'school_classes.id','=','teacher_classes.ClassId')
                            // ->join("schools",'school_classes.SchoolCode','=','schools.SchoolCode')
                            ->join("schools",'head_teachers.SchoolId','=','schools.id')
                            ->Join('class_levels','head_teachers.teachingLevel' , '=','class_levels.id')
                            ->where('schools.SchoolCode', $user[0]["SchoolCode"])
                            ->where('users.Gender', 'Female')
                            ->where('class_levels.id', $classLevel->classLevel)
                        ->count();
                      
            
                    $totalMales =  User::join('head_teachers','head_teachers.userId','=','users.id')
                            //->join('teacher_classes', 'teacher_classes.TeacherId', '=', 'users.id')
                            //->join("school_classes",'school_classes.id','=','teacher_classes.ClassId')
                            //->join("schools",'school_classes.SchoolCode','=','schools.SchoolCode')
                            ->join("schools",'head_teachers.SchoolId','=','schools.id')
                            ->Join('class_levels','head_teachers.teachingLevel' , '=','class_levels.id')
                            ->where('schools.SchoolCode', $user[0]["SchoolCode"])
                            ->where('users.Gender', 'Male')
                            ->where('class_levels.id', $classLevel->classLevel)
                        ->count();
              
            
                    $studentsAttendance =User::join('head_teachers','head_teachers.userId','=','users.id')
                        //->join('teacher_classes', 'teacher_classes.TeacherId', '=', 'users.id')
                       // ->join("school_classes",'school_classes.id','=','teacher_classes.ClassId')
                        ->join("schools",'head_teachers.SchoolId','=','schools.id')
                        ->Join('class_levels','head_teachers.teachingLevel' , '=','class_levels.id')
                        ->leftJoin('teachers', 'users.id', '=', 'teachers.teacherId')
                        ->where('schools.SchoolCode', $user[0]["SchoolCode"])
                        ->where('class_levels.id', $classLevel->classLevel)
        
                        ->where(function ($query) use ($inputData) {
                            $query->whereBetween('teachers.attendedDay', [$inputData['fromDate'], $inputData['toDate']])
                                  ->orWhereNull('teachers.attendedDay');
                        })
                        ->select(
                            DB::raw('class_levels.levels'),
                            DB::raw('COALESCE(teachers.attendedDay, "No Attendance") as attendedDay'), // Handle null dates
                            DB::raw('COUNT(DISTINCT users.id) as totalRegistered'), // Total registered students (distinct)
                            DB::raw('SUM(CASE WHEN users.Gender = "Female" THEN 1 ELSE 0 END) as totalFemale'), // Total female students
                            DB::raw('SUM(CASE WHEN users.Gender = "Male" THEN 1 ELSE 0 END) as totalMale'), // Total male students
                            DB::raw('SUM(CASE WHEN teachers.status = "Present" THEN 1 ELSE 0 END) as totalPresent'), // Total present students
                            DB::raw('SUM(CASE WHEN users.Gender = "Female" AND teachers.status = "Present" THEN 1 ELSE 0 END) as totalPresentFemale'), // Total present female students
                            DB::raw('SUM(CASE WHEN users.Gender = "Male" AND teachers.status = "Present" THEN 1 ELSE 0 END) as totalPresentMale') // Total present male students
                        )
                        ->groupBy('class_levels.levels', 'teachers.attendedDay')
                        ->get();
            
                    // Create a map to ensure all dates within the range are included
                    $dateRange = [];
                    $currentDate = strtotime($inputData['fromDate']);
                    $endDate = strtotime($inputData['toDate']);
                    while ($currentDate <= $endDate) {
                        $dateRange[date('Y-m-d', $currentDate)] = [
                            'ClassLevel' => $classLevel->classLevel,
                            'attendedDay' => date('Y-m-d', $currentDate),
                            'totalRegistered' => $totalTeachers,
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
                    $teachersAttendance = array_values($dateRange);
        
                    // Sort the attendance data by date in descending order
                    usort($teachersAttendance, function($a, $b) {
                        return strtotime($b['attendedDay']) - strtotime($a['attendedDay']);
                    });
        
                    $result[] = [
                        'classLevel' => $classLevel->classLevel,
                        'levels' => $classLevel->levels,
                        'TeachersAttendance' => $teachersAttendance
                    ];
                }
            
                return response()->json($result);
            } 
        
    

 public function SEO_SectorTeacherAttendance(Request $request){
    $inputData = $request->all();
    $user_id=Auth::user()->id;
    $user=User::Join('sector_leaders', 'users.id','=','sector_leaders.UserId') 
    ->Join('sectors','sectors.id' , '=','sector_leaders.SectorId')
    ->where('users.id','=',$user_id)
    ->get(['sectors.id']);

    //return response()->json($user);

$data1 = SchoolClass::join("class_levels",'class_levels.id','=','school_classes.classLevel')
    ->select('school_classes.classLevel','class_levels.levels')
    ->groupBy('class_levels.id','class_levels.levels','school_classes.classLevel')
    ->get();
   
    $result = [];

    // Loop through each class level
    foreach ($data1 as $classLevel) {
        $totalTeachers = User::join('head_teachers','head_teachers.userId','=','users.id')
            ->join("schools",'head_teachers.SchoolId','=','schools.id')
            ->Join('class_levels','head_teachers.teachingLevel' , '=','class_levels.id')
            ->join('sectors','sectors.SectorCode','=','schools.SectorCode')
            //->leftJoin('teachers', 'users.id', '=', 'teachers.teacherId')
            ->where('sectors.id', $user[0]["id"])
            ->where('class_levels.id', $classLevel->classLevel)
            ->count();
           
     
              
            
                    $totalFemales = User::join('head_teachers','head_teachers.userId','=','users.id')
                            ->join("schools",'head_teachers.SchoolId','=','schools.id')
                            ->Join('class_levels','head_teachers.teachingLevel' , '=','class_levels.id')
                            ->join('sectors','sectors.SectorCode','=','schools.SectorCode')
                            //->leftJoin('teachers', 'users.id', '=', 'teachers.teacherId')
                            ->where('sectors.id', $user[0]["id"])
                            ->where('users.Gender', 'Female')
                            ->where('class_levels.id', $classLevel->classLevel)
                        ->count();
                      
            
                    $totalMales =  User::join('head_teachers','head_teachers.userId','=','users.id')
                            ->join("schools",'head_teachers.SchoolId','=','schools.id')
                            ->Join('class_levels','head_teachers.teachingLevel' , '=','class_levels.id')
                            ->join('sectors','sectors.SectorCode','=','schools.SectorCode')
                            //->leftJoin('teachers', 'users.id', '=', 'teachers.teacherId')
                            ->where('sectors.id', $user[0]["id"])
                            ->where('users.Gender', 'Male')
                            ->where('class_levels.id', $classLevel->classLevel)
                        ->count();
              
            
                    $studentsAttendance =User::join('head_teachers','head_teachers.userId','=','users.id')
                        ->join("schools",'head_teachers.SchoolId','=','schools.id')
                        ->Join('class_levels','head_teachers.teachingLevel' , '=','class_levels.id')
                        ->join('sectors','sectors.SectorCode','=','schools.SectorCode')
                        ->leftJoin('teachers', 'users.id', '=', 'teachers.teacherId')
                        ->where('sectors.id', $user[0]["id"])
                        ->where('class_levels.id', $classLevel->classLevel)
        
                        ->where(function ($query) use ($inputData) {
                            $query->whereBetween('teachers.attendedDay', [$inputData['fromDate'], $inputData['toDate']])
                                  ->orWhereNull('teachers.attendedDay');
                        })
                        ->select(
                            DB::raw('class_levels.levels'),
                            DB::raw('COALESCE(teachers.attendedDay, "No Attendance") as attendedDay'), // Handle null dates
                            DB::raw('COUNT(DISTINCT users.id) as totalRegistered'), // Total registered students (distinct)
                            DB::raw('SUM(CASE WHEN users.Gender = "Female" THEN 1 ELSE 0 END) as totalFemale'), // Total female students
                            DB::raw('SUM(CASE WHEN users.Gender = "Male" THEN 1 ELSE 0 END) as totalMale'), // Total male students
                            DB::raw('SUM(CASE WHEN teachers.status = "Present" THEN 1 ELSE 0 END) as totalPresent'), // Total present students
                            DB::raw('SUM(CASE WHEN users.Gender = "Female" AND teachers.status = "Present" THEN 1 ELSE 0 END) as totalPresentFemale'), // Total present female students
                            DB::raw('SUM(CASE WHEN users.Gender = "Male" AND teachers.status = "Present" THEN 1 ELSE 0 END) as totalPresentMale') // Total present male students
                        )
                        ->groupBy('class_levels.levels', 'teachers.attendedDay')
                        ->get();
            
                    // Create a map to ensure all dates within the range are included
                    $dateRange = [];
                    $currentDate = strtotime($inputData['fromDate']);
                    $endDate = strtotime($inputData['toDate']);
                    while ($currentDate <= $endDate) {
                        $dateRange[date('Y-m-d', $currentDate)] = [
                            'ClassLevel' => $classLevel->classLevel,
                            'attendedDay' => date('Y-m-d', $currentDate),
                            'totalRegistered' => $totalTeachers,
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
                    $teachersAttendance = array_values($dateRange);
        
                    // Sort the attendance data by date in descending order
                    usort($teachersAttendance, function($a, $b) {
                        return strtotime($b['attendedDay']) - strtotime($a['attendedDay']);
                    });
        
                    $result[] = [
                        'classLevel' => $classLevel->classLevel,
                        'levels' => $classLevel->levels,
                        'TeachersAttendance' => $teachersAttendance
                    ];
                }
            
                return response()->json($result);
            } 
        }
        