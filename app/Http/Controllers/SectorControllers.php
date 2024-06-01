<?php

namespace App\Http\Controllers;
use App\Models\Sector;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SectorControllers extends Controller
{
    //
    
    public function index()
    {
        //
        $sector=Sector::all();
        return response()->json($sector);
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
