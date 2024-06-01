<?php

namespace App\Http\Controllers;
use App\Models\Teacher;
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
        $inputData=$request->all();
        $data=Teacher::create([
            "Schoolcode"=> $inputData["Schoolcode"],
            "position"=> $inputData["position"],
            "RepresentationClass"=> $inputData["RepresentationClass"],
            "FirstName"=> $inputData["FirstName"],
            "LastName"=> $inputData["LastName"],
            "email"=> $inputData["email"],
            "Telephone"=>  $inputData["Telephone"] 
        ]);

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
