<?php

namespace App\Http\Controllers;
use App\Models\Sector;
use App\Models\User;
use App\Models\SectorLeader;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SectorControllers extends Controller
{
    //
    
    public function index()
    {
        //
        $sector=Sector::leftJoin('sector_leaders','sector_leaders.SectorId','=','sectors.id')
                ->leftJoin('users','users.id','=','sector_leaders.userId')
                ->get();

          return response()->json($sector);
    }

    public function AllSEO(){
        $user=User::where('position','=','SEO')->get();
        return response()->json($user);
    }

   public function addNewSEO(Request $request){
    $inputData=$request->all();
    $data = SectorLeader::where('SectorId', $inputData["SectorId"])->first();
    if($data){
        $data->update(["userId" => $inputData["userId"]]);
    }else{
        $data=SectorLeader::create([
            "SectorId"=> $inputData["SectorId"],
            "userId"=> $inputData["userId"]
        ]);
    }
  
    return response()->json($data);

    //return response()->json($inputData);
   }

   public function SEO_StaffInSector(){
    if (Auth::check()) {
        $sector =Sector::leftJoin('sector_leaders','sector_leaders.SectorId','=','sectors.id')
        ->leftJoin('users','users.id','=','sector_leaders.userId')
        ->first();
        
        $data=User::join('head_teachers','head_teachers.userId','=','users.id')
                    ->join("schools",'schools.id','=','head_teachers.SchoolId')
                    ->where('schools.SectorCode','=',$sector['SectorCode'])
                    ->select('users.firstName','users.lastName','users.email','users.Telephone','users.created_at','schools.SchoolName','schools.SchoolCode')
                    ->get();
        return response()->json($data);          
    }
   }


   public function SEO_StaffbySchool(Request $request){
    if (Auth::check()) {
      $inputData=$request->all();  
        $data=User::join('head_teachers','head_teachers.userId','=','users.id')
                    ->join("schools",'schools.id','=','head_teachers.SchoolId')
                    ->where('schools.id','=',$inputData['schoolId'])
                    ->select('users.firstName','users.lastName','users.email','users.Telephone','users.created_at','schools.SchoolName','schools.SchoolCode')
                    ->get();
        return response()->json($data);          
    }
   }
    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        
        $initial=10000;
        $sector=Sector::all()->count();
        $result=$initial+$sector+1;
        $result=(string) $result;
        $result=substr($result,3);
        $inputData=$request->all();
        $data=Sector::create([
            "SectorCode"=>$result,
            "SectorName"=>$inputData["SectorName"]
        ]);
        return response()->json($data);
    }
}
