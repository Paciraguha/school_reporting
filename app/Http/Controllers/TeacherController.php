<?php

namespace App\Http\Controllers;
use App\Models\Teacher;
use App\Models\User;
use App\Models\SchoolClass;
use App\Models\ClassLevel;
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
           // return response()->json($user);
            $data=User::Join('head_teachers', 'users.id','=','head_teachers.UserId')
             ->Join('schools','head_teachers.SchoolId','=','schools.id')
             ->join('teacher_classes','teacher_classes.TeacherId','=','users.id' )
             ->join('school_classes','teacher_classes.ClassId','=','school_classes.id')
             ->leftJoin('teachers','users.id','=','teachers.teacherId')
            ->where('schools.SchoolCode',$user[0]["SchoolCode"])
            //->where('attendedDay','=',$inputData['reportdate'])
            ->get(['users.id','users.created_at','users.firstName','users.lastName','users.email','users.Telephone','schools.SchoolName','school_classes.SchoolClass','teachers.teacherId','teachers.status','teachers.attendedDay']);
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
