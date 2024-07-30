<?php

namespace App\Http\Controllers;
use App\Models\School;
use App\Models\SchoolClass;
use App\Models\User;
use App\Models\Sector;
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
     
        if (Auth::check()) {
            $loggeduser=Auth::user();

       // return response()->json($loggeduser);
            if($loggeduser['position']==="DEO"){
                
               // return response()->json($request['sectorCode']);
                if(isset($request['sectorCode'])){
                    $schools = School::where('SectorCode',$request['sectorCode'])->get();
    
                    foreach ($schools as $school) {
                        $combinationIds = $school->SchoolLevels;
                        $schoolLevel = ClassLevel::whereIn('id', $combinationIds)->get(['levels']);
                        $school->SchoolLevels = $schoolLevel; // Attach schoolLevel to the school instance
                    }
                    return response()->json($schools);

                }else{
                $schools = School::all();
                foreach ($schools as $school) {
                    $combinationIds = $school->SchoolLevels;
                    $schoolLevel = ClassLevel::whereIn('id', $combinationIds)->get(['levels']);
                    $school->SchoolLevels = $schoolLevel; // Attach schoolLevel to the school instance
                }
               return response()->json($schools);
                 }
            }else if($loggeduser['position']==="SEO"){
                 $user_id=Auth::user()->id;
                $sector=User::Join('sector_leaders', 'users.id','=','sector_leaders.UserId') 
                ->Join('sectors','sectors.id' , '=','sector_leaders.SectorId')
                ->where('users.id','=',$user_id)
                ->get(['sectors.id','sectors.SectorCode']);
            
               // return response()->json($sector['SectorCode']);
                $schools = School::where('SectorCode',$sector[0]['SectorCode'])->get();
    
                foreach ($schools as $school) {
                    $combinationIds = $school->SchoolLevels;
                    $schoolLevel = ClassLevel::whereIn('id', $combinationIds)->get(['levels']);
                    $school->SchoolLevels = $schoolLevel; // Attach schoolLevel to the school instance
                }
                return response()->json($schools);
            }
           
    }else{
        return response()->json(['error' => 'Unauthenticated'], 401);  
    }
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



public function updateSchool(Request $request){
    $inputData = $request->all();
    $data = School::find($inputData["SchoolId"]);
 
    if ($data) {
        $data->update([
            "SectorCode"=>$inputData["SectorCode"],
            "SchoolName"=>$inputData["SchoolName"],
            "SchoolLevels"=>$inputData["schoolLevel"],
        ]);
        return response()->json(["data" => $data, "message" => "School class updated successfully"]);
    } else {
        return response()->json(["message" => "School class not found"], 404);
    }
}


public function deleteschoolinfo($id){
    $school = School::find($id);
        if ($school) {
            $school->delete();
            return response()->json(["message" => "School data is successfully deleted"]);
        } else {
            return response()->json(["message" => "School not found"], 404);
        }
}


public function  getClassLevels(){
        $data=ClassLevel::all();
        return response()->json($data);  
    }


public function addClasses(Request $request){
        $inputData=$request->all();
        $this->middleware('auth:sanctum');
        $user_id=Auth::user()->id;
        
        $user=User::Join('head_teachers', 'users.id','=','head_teachers.UserId') 
        ->Join('schools','head_teachers.SchoolId' , '=','schools.id' )
        ->where('users.id','=',$user_id)
        ->get(['schools.SchoolCode','schools.id']);


        $data=SchoolClass::create([
            "SchoolCode"=>$user[0]["SchoolCode"],
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
        $this->middleware('auth:sanctum');
        $user_id=Auth::user()->id;

        $user=User::Join('head_teachers', 'users.id','=','head_teachers.UserId') 
        ->Join('schools','head_teachers.SchoolId' , '=','schools.id' )
        ->where('users.id','=',$user_id)
        ->get(['schools.SchoolCode','schools.id as schoolId']);
       

        $schools = School::where('id',$user[0]["schoolId"])->get();
        foreach ($schools as $school) {
            $combinationIds = $school->SchoolLevels;
            $schoolLevel = ClassLevel::whereIn('id', $combinationIds)->get(['id','levels']);
            $school->SchoolLevels = $schoolLevel; 
        }
        return response()->json($school);
    }

    public function getAllSchoolClasses(){
        $this->middleware('auth:sanctum');
        $user_id=Auth::user()->id;
        //return response()->json($user_id);
        $user=User::Join('head_teachers', 'users.id','=','head_teachers.UserId') 
        ->Join('schools','head_teachers.SchoolId' , '=','schools.id' )
        ->where('users.id','=',$user_id)
        ->get(['schools.SchoolCode']);

        $schoolClass=SchoolClass::where('SchoolCode',$user[0]["SchoolCode"])->get();
        return response()->json($schoolClass); 
    }
    /**
     * Store a newly created resource in storage.
     */

     public function updateSchoolClass(Request $request) {
        $inputData = $request->all();
        $data = SchoolClass::find($inputData["class_id"]);
     
        if ($data) {
            $data->update([
                "classLevel" => $inputData["ClassSection"],
                "SchoolClass" => $inputData["SchoolClass"]
            ]);
            return response()->json(["data" => $data, "message" => "School class updated successfully"]);
        } else {
            return response()->json(["message" => "School class not found"], 404);
        }
    }



    public function AllSchoolLevel($id){
        $school=School::where('id','=',$id)->first();
        if (!$school) {
            return response()->json(['error' => 'School not found'], 404);
        }
        
        $schoolLevels = $school->SchoolLevels;
        $data1 = ClassLevel::whereIn('id', $schoolLevels)->get();

        return response()->json($data1);
    }



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