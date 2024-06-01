<?php

namespace App\Http\Controllers;
use App\Models\StudentReport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
   
    public function index()
    {
        $report=StudentReport::all();
        return response()->json($report);
    }
    public function create(Request $request)
    {
        $report=$request->all();
       // return response()->json($report);
        $report1=$report["nusery"];
        $report2=$report["Primary"];
        $report3=$report["Olevel"];
        $report4=$report["Alevel"];
       
 
    $report=StudentReport::create([
        "NurseryExpectedBoy"  =>  $report1["NurseryExpectedBoy"],
        "NurseryExpectedGirl"  =>  $report1["NurseryExpectedGirl"],
        "NurseryExpectedTotal"  =>  $report1["NurseryExpectedTotal"],
        "NurseryAttendedBoy"  =>  $report1["NurseryAttendedBoy"],
        "NurseryAttendedGirl"  =>  $report1["NurseryAttendedGirl"],
        "NurseryAttendedTotal"  =>  $report1["NurseryAttendedTotal"],
        "NurseryPercentage"  =>  $report1["NurseryPercentage"],
        "PrimaryExpectedBoy"  =>  $report2["PrimaryExpectedBoy"],
        "PrimaryExpectedGirl"  =>  $report2["PrimaryExpectedGirl"],
        "PrimaryExpectedTotal"  =>  $report2["PrimaryExpectedTotal"],
        "PrimaryAttendedBoy"  =>  $report2["PrimaryAttendedBoy"],
        "PrimaryAttendedGirl"  =>  $report2["PrimaryAttendedGirl"],
        "PrimaryAttendedTotal"  =>  $report2["PrimaryAttendedTotal"],
        "PrimaryPercentage"  =>  $report2["PrimaryPercentage"],
        "OlevelExpectedBoy"  =>  $report3["OlevelExpectedBoy"],
        "OlevelExpectedGirl"  =>  $report3["OlevelExpectedGirl"],
        "OlevelExpectedTotal"  =>  $report3["OlevelExpectedTotal"],
        "OlevelAttendedBoy"  =>  $report3["OlevelAttendedBoy"],
        "OlevelAttendedGirl"  =>  $report3["OlevelAttendedGirl"],
        "OlevelAttendedTotal"  =>  $report3["OlevelAttendedTotal"],
        "OlevelPercentage"  =>  $report3["OlevelPercentage"],
        "AlevelExpectedBoy"  =>  $report4["AlevelExpectedBoy"],
        "AlevelExpectedGirl"  =>  $report4["AlevelExpectedGirl"],
        "AlevelExpectedTotal"  =>  $report4["AlevelExpectedTotal"],
        "AlevelAttendedBoy"  =>  $report4["AlevelAttendedBoy"],
        "AlevelAttendedGirl"  =>  $report4["AlevelAttendedGirl"],
        "AlevelAttendedTotal"  =>  $report4["AlevelAttendedTotal"],
        "AlevelPercentage"  =>  $report4["AlevelPercentage"],
        ]);
       return response()->json($report);
    }
    
}
