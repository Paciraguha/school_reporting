<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\HeadTeacherController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\SectorControllers;
//Route::get('/user', [UserController::class, 'index']);

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('/register',[RegisterController::class, 'create'])->name("registerStaff");
Route::post('/login',[LoginController::class, 'userLogin'])->name("loginStaff");

// Route::group(["middleware"=>["auth:sanctum"]],function(){
    
//  Route::post('/reports', [ReportController::class, 'create'])->name("addStudentsReport");
//  Route::get('/reports', [ReportController::class, 'index'])->name("getStudentsReport");

//  Route::post('/teachers', [TeacherController::class, 'create']);

//  Route::get('/schoolLevels', [SchoolController::class, 'getClassLevels'])->name('getClassLevels');
//  Route::get('/schoolLevelsOfSchool', [SchoolController::class, 'getClassLevelsOfSchool'])->name('getClassLevelsOfSchool');
//  Route::post('/schools', [SchoolController::class, 'create'])->name('addNewSchool');

//  Route::post('/schoolClasses', [SchoolController::class, 'addClasses'])->name("apiAddSchoolClass");

//  Route::get('/schools', [SchoolController::class, 'index'])->name('getAllSchools');
//  Route::get('/schoolClasses/{id}', [SchoolController::class, 'getAllClassInSchool'])->name("apiGetAllClassInSchool");
//  Route::get('/allSchoolClasses', [SchoolController::class, 'getAllSchoolClasses'])->name("apiGetSchoolClass");

//  Route::get('/schools/{id}', [SchoolController::class, 'show'])->name('getAllSchoolsOfSector');
//  Route::post('/schoolLeader', [HeadTeacherController::class, 'create'])->name("apischoolStaffList");
//  Route::get('/Teachers', [HeadTeacherController::class, 'listAllTeacher'])->name("apiGetAllSchoolTeachers");
//  Route::get('/HeadTeachers', [HeadTeacherController::class, 'listAllHeadTeacher'])->name("apiGetAllSchoolHeadTeachers");
//  Route::post('/Teachers', [HeadTeacherController::class, 'assignClassToTeacher'])->name("apiAssignClassToTeacher");

//  Route::post('/sectors', [SectorControllers::class, 'create'])->name('addNewSector');;
//  Route::get('/sectors', [SectorControllers::class, 'index'])->name('getAllSectors');

//  Route::post('/students', [StudentController::class, 'create'])->name('apiAddStudents');
//  Route::get('/students', [StudentController::class, 'index'])->name('getAllStudent');
//  Route::post('/studentAttendance', [StudentController::class, 'studentsAttendance'])->name('studentsAttendance');
//  Route::get('/studentAttendance', [StudentController::class, 'getStudentsAttendance'])->name('getStudentsAttendance');

// })


 Route::group(["middleware"=>["auth:sanctum"]],function(){
    
    // Routes related to reports
    Route::post('/reports', [ReportController::class, 'create'])->name("addStudentsReport");
    Route::get('/reports', [ReportController::class, 'index'])->name("getStudentsReport");

    // Route to create a teacher
    Route::post('/teachers', [TeacherController::class, 'create']);

    // Routes related to school levels
    Route::get('/schoolLevels', [SchoolController::class, 'getClassLevels'])->name('getClassLevels');
    Route::get('/schoolLevelsOfSchool', [SchoolController::class, 'getClassLevelsOfSchool'])->name('getClassLevelsOfSchool');

    // Routes related to schools
    Route::post('/schools', [SchoolController::class, 'create'])->name('addNewSchool');
    Route::get('/schools', [SchoolController::class, 'index'])->name('getAllSchools');
    Route::get('/schools/{id}', [SchoolController::class, 'show'])->name('getAllSchoolsOfSector');

    // Route to add classes to a school
    Route::post('/schoolClasses', [SchoolController::class, 'addClasses'])->name("apiAddSchoolClass");
    Route::get('/allSchoolClasses', [SchoolController::class, 'getAllSchoolClasses'])->name("apiGetSchoolClass");
    Route::get('/schoolClasses/{id}', [SchoolController::class, 'getAllClassInSchool'])->name("apiGetAllClassInSchool");

    // Routes related to school leaders (head teachers)
    Route::post('/schoolLeader', [HeadTeacherController::class, 'create'])->name("apischoolStaffList");
    Route::get('/Teachers', [HeadTeacherController::class, 'listAllTeacher'])->name("apiGetAllSchoolTeachers");
    Route::get('/HeadTeachers', [HeadTeacherController::class, 'listAllHeadTeacher'])->name("apiGetAllSchoolHeadTeachers");
    Route::post('/Teachers', [HeadTeacherController::class, 'assignClassToTeacher'])->name("apiAssignClassToTeacher");

    // Routes related to sectors
    Route::post('/sectors', [SectorControllers::class, 'create'])->name('addNewSector');
    Route::get('/sectors', [SectorControllers::class, 'index'])->name('getAllSectors');

    // Routes related to students

    Route::post('/students', [StudentController::class, 'create'])->name('apiAddStudents');
    Route::get('/students', [StudentController::class, 'index'])->name('getAllStudent');
    Route::get('/studentsByClass', [StudentController::class, 'allStudentsInClass'])->name('getAllInStudent');
  
    Route::post('/studentAttendance', [StudentController::class, 'studentsAttendance'])->name('studentsAttendance');
    Route::get('/studentAttendance', [StudentController::class, 'getStudentsAttendance'])->name('getStudentsAttendance');
    Route::get('/studentAttendanceDetail/{id}', [StudentController::class, 'studentsAttendanceDetail'])->name('getStudentAttendanceDetail');
    Route::get('/studentAttendanceScore', [StudentController::class, 'getAllStudentAttendanceScore'])->name('getStudentsAttendanceScore');
    
});