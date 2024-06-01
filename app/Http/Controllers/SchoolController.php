<?php

namespace App\Http\Controllers;
use App\Models\School;
use App\Models\SchoolClass;
use App\Models\User;
use App\Models\ClassLevel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        //$this->middleware('auth');
        //$this->user =  Auth::user();
        $this->user=User::Join('head_teachers', 'users.id','=','head_teachers.UserId') 
        ->Join('schools','head_teachers.SchoolId' , '=','schools.id' )
        ->where('users.id','=','1')
        ->get(['schools.SchoolCode']);
     
    }
    public function index(Request $request)
    {
     
        
        $schools = School::all();

        foreach ($schools as $school) {
            $combinationIds = $school->SchoolLevels;
            $schoolLevel = ClassLevel::whereIn('id', $combinationIds)->get(['levels']);
            $school->SchoolLevels = $schoolLevel; // Attach schoolLevel to the school instance
        }
    
      return response()->json($schools);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
        $inputData=$request->all();
      
        $initial=10000;
        $school=School::all()->count();
        $result=$initial+$school+1;
        $result=(string) $result;
        $result=substr($result,2);
        //return response()->json($result);
        $data=School::create([
            "SectorCode"=>$inputData["SectorCode"],
            "SchoolCode"=>$result,
            "SchoolName"=>$inputData["SchoolName"],
            "SchoolLevels"=>$inputData["schoolLevel"],
        ]);
        return response()->json($data);
    }

    public function  getClassLevels(){
        $data=ClassLevel::all();
        return response()->json($data);  
    }


    public function addClasses(Request $request){
        $inputData=$request->all();
        
        $data=SchoolClass::create([
            "SchoolCode"=>"001",
            "classLevel"=>$inputData["ClassSection"],
            "SchoolClass"=>$inputData["SchoolClass"]
        ]);
        return response()->json($data);
    }

    public function getAllClassInSchool($id){
        $schoolClass=SchoolClass::where('SchoolCode',$id)->get();
        return response()->json($schoolClass);
    }

    public function getClassLevelsOfSchool(){
        $schools = School::where('id','1')->get();
        foreach ($schools as $school) {
            $combinationIds = $school->SchoolLevels;
            $schoolLevel = ClassLevel::whereIn('id', $combinationIds)->get(['id','levels']);
            $school->SchoolLevels = $schoolLevel; // Attach schoolLevel to the school instance
        }
        return response()->json($school);
    }

    public function getAllSchoolClasses(){
        $schoolClass=SchoolClass::where('SchoolCode','001')->get();
        return response()->json($schoolClass); 
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
        $school=School::where('SectorCode',$id)->get();
        
        return response()->json($school);
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
