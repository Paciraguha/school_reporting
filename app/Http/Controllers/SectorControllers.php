<?php

namespace App\Http\Controllers;
use App\Models\Sector;
use App\Models\User;
use App\Models\SectorLeader;
use Illuminate\Support\Facades\DB;
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
                
                ->select("sectors.id as SectorId","sectors.SectorCode","sectors.SectorName",
                        "sector_leaders.userId",
                        "users.firstName",
                        "users.lastName",
                        "users.email",
                        "users.Telephone",
                        "users.position",
                        "users.Gender")
            ->get();
          return response()->json($sector);
    }

    public function AllSEO(){
        $user=User::where('position','=','SEO')->get();
        return response()->json($user);
    }


   public function addNewSEO(Request $request){
    $inputData=$request->all();

    $data1 = Sector::where('id', $inputData["SectorId"])->first();
   
    if($data1){
        $data1->update(["SectorName" => $inputData["SectorName"]]);
    }
  
    $data = SectorLeader::where('SectorId', $inputData["SectorId"])->first();
    if($data){
        $data->update(["userId" => $inputData["userId"]]);
    }else{
        $data=SectorLeader::create([
            "SectorId"=> $inputData["SectorId"],
            "userId"=> $inputData["userId"]
        ]);
    }
  
    return response()->json(["message"=>"sector information updated successful", "data"=>$data]);

    //return response()->json($inputData);
   }

   public function SEO_StaffInSector(){
    if (Auth::check()) {
        $user_id=Auth::user()->id;
        $sector=User::Join('sector_leaders', 'users.id','=','sector_leaders.UserId') 
        ->Join('sectors','sectors.id' , '=','sector_leaders.SectorId')
        ->where('users.id','=',$user_id)
        ->get(['sectors.id','sectors.SectorCode']);

        
         $data=User::join('head_teachers','head_teachers.userId','=','users.id')
        ->join("schools",'schools.id','=','head_teachers.SchoolId')
        ->leftJoin('teachers', 'users.id', '=', 'teachers.teacherId')
        //->where('users.position','=','teacher')
        ->where('schools.SectorCode','=',$sector[0]['SectorCode'])
        ->groupBy('users.id',
            'users.created_at',
            'users.firstName',
            'users.lastName',
            'users.email',
            'users.position',
            'users.Telephone',
            'schools.SchoolCode',
            'schools.SchoolName')
        ->select(
            'users.id',
            'users.created_at',
            'users.firstName',
            'users.lastName',
            'users.email',
            'users.position',
            'users.Telephone',
            'schools.SchoolCode',
            'schools.SchoolName',
            DB::raw('COUNT(teachers.teacherId) as totalRegistered'),
            DB::raw('SUM(CASE WHEN teachers.status = "Present" THEN 1 ELSE 0 END) as totalPresent'),
            DB::raw('SUM(CASE WHEN teachers.status = "Absent" THEN 1 ELSE 0 END) as totalAbsent'),
        )
        ->get();
        return response()->json($data);


        $data=User::join('head_teachers','head_teachers.userId','=','users.id')
                    ->join("schools",'schools.id','=','head_teachers.SchoolId')
                    ->leftJoin('teachers', 'users.id', '=', 'teachers.teacherId')
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
                    ->leftJoin('teachers', 'users.id', '=', 'teachers.teacherId')
                    ->where('schools.id','=',$inputData['schoolId'])
                    
                    //->where('users.position','=','teacher')
                  
                    ->groupBy('users.id',
                        'users.created_at',
                        'users.firstName',
                        'users.lastName',
                        'users.email',
                        'users.position',
                        'users.Telephone',
                        'schools.SchoolCode',
                        'schools.SchoolName')
                    ->select(
                        'users.id',
                        'users.created_at',
                        'users.firstName',
                        'users.lastName',
                        'users.email',
                        'users.position',
                        'users.Telephone',
                        'schools.SchoolCode',
                        'schools.SchoolName',
                        DB::raw('COUNT(teachers.teacherId) as totalRegistered'),
                        DB::raw('SUM(CASE WHEN teachers.status = "Present" THEN 1 ELSE 0 END) as totalPresent'),
                        DB::raw('SUM(CASE WHEN teachers.status = "Absent" THEN 1 ELSE 0 END) as totalAbsent'),
                    )
                    ->get();
                    return response()->json($data);
            
                    // ->select('users.firstName','users.lastName','users.email','users.Telephone','users.created_at','schools.SchoolName','schools.SchoolCode')
                    // ->get();
       // return response()->json($data);          
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


public function deleteSector($id){
    $sector = Sector::find($id);
        if ($sector) {
            $sector->delete();
            return response()->json(["message" => "Sector data is successfully deleted"]);
        } else {
            return response()->json(["message" => "Sector not found"], 404);
        }
    }
}

