<?php

namespace App\Http\Controllers;
use App\Models\Teacher;
use App\Models\User;
use App\Models\SchoolClass;
use App\Models\ClassLevel;
use App\Models\School;
use App\Models\Sector;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
     
         
                return view('home');
          
           
       // 
    }

    public function SummaryStatistic(){
        if(Auth::user()->position==="DEO"){  
            $totalstudents = Student::count();
            $totalsector = Sector::count();
            $totalschool = School::count();
            $totalstaff = User::whereIn('position', ['Teacher', 'DOS', 'HeadTeacher'])->count();
            
            $data1 = ClassLevel::all();
            
            $result = [];
            
            foreach ($data1 as $classLevel) {
                $studentsAttendance = Student::join('school_classes', 'students.ClassLevel', '=', 'school_classes.id')
                    ->join('schools', 'schools.SchoolCode', '=', 'school_classes.SchoolCode')
                    ->where('school_classes.ClassLevel', $classLevel->id)
                    ->select(
                        'school_classes.ClassLevel',
                        DB::raw('COUNT(DISTINCT students.id) as totalRegistered'), 
                        DB::raw('COUNT(DISTINCT CASE WHEN students.Gender = "Female" THEN students.id ELSE NULL END) as totalFemale'),
                        DB::raw('COUNT(DISTINCT CASE WHEN students.Gender = "Male" THEN students.id ELSE NULL END) as totalMale')
                    )
                    ->groupBy('school_classes.ClassLevel')
                    ->first();
            
                $result[] = [
                    'classLevel' => $classLevel->classLevel,
                    'levels' => $classLevel->levels,
                    'totalRegistered' => $studentsAttendance->totalRegistered ?? 0,
                    'totalFemale' => $studentsAttendance->totalFemale ?? 0,
                    'totalMale' => $studentsAttendance->totalMale ?? 0,
                ];
            }
            
            $summary = [
                "Totalstudent" => $totalstudents,
                "totalsector" => $totalsector,
                "totalschool" => $totalschool,
                "totalstaff" => $totalstaff,
            ];
            
            $result = [
                'summary' => $summary,
                'details' => $result
            ];
            
            return response()->json($result);
            
        }else if(Auth::user()->position==="SEO"){  

        
            $sector=Sector::join('sector_leaders','sector_leaders.SectorId','=','sectors.id')
            ->join('users','users.id','=','sector_leaders.userId')
            ->where("sector_leaders.userId","=",Auth::user()->id)
            ->first();
           
                $data1 = ClassLevel::all();
            
                $result = [];
        
             
                $totalstudents =Student::join('school_classes', 'students.ClassLevel', '=', 'school_classes.id')
                                ->join('schools', 'schools.SchoolCode', '=', 'school_classes.SchoolCode')
                                ->where('schools.SectorCode', $sector['SectorCode'])->count();
                                

                $totalschool = School::where('SectorCode', $sector['SectorCode'])->count();

                $totalstaff = User::join('head_teachers', 'head_teachers.userId', '=', 'users.id')
                 ->join("schools",'schools.id','=','head_teachers.SchoolId')
                 ->where('schools.SectorCode', $sector['SectorCode'])
                 ->whereIn('position', ['Teacher', 'DOS', 'HeadTeacher'])
                 ->count();
               

                $data1 = ClassLevel::all();
                
                $result = [];
                
                foreach ($data1 as $classLevel) {
                        $studentsAttendance = Student::join('school_classes', 'students.ClassLevel', '=', 'school_classes.id')
                        ->join('schools', 'schools.SchoolCode', '=', 'school_classes.SchoolCode')
                        ->where('schools.SectorCode', $sector['SectorCode'])
                        ->where('school_classes.ClassLevel', $classLevel->id)
                        ->select(
                            'school_classes.ClassLevel',
                            DB::raw('COUNT(DISTINCT students.id) as totalRegistered'), // Total registered students (distinct)
                            DB::raw('COUNT(DISTINCT CASE WHEN students.Gender = "Female" THEN students.id ELSE NULL END) as totalFemale'), // Total female students
                            DB::raw('COUNT(DISTINCT CASE WHEN students.Gender = "Male" THEN students.id ELSE NULL END) as totalMale'), // Total male students
                          
                        )
                        ->groupBy('school_classes.ClassLevel')
                        ->first();
            
                
                    $result[] = [
                        'classLevel' => $classLevel->classLevel,
                        'levels' => $classLevel->levels,
                        'totalRegistered' => $studentsAttendance->totalRegistered ?? 0,
                        'totalFemale' => $studentsAttendance->totalFemale ?? 0,
                        'totalMale' => $studentsAttendance->totalMale ?? 0,
                    ];
                }
                
                $summary = [
                    "Totalstudent" => $totalstudents,
                    "totalschool" => $totalschool,
                    "totalstaff" => $totalstaff,
                ];
                
                $result = [
                    'summary' => $summary,
                    'details' => $result
                ];
                
                return response()->json($result);

         }
    }
}


