<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
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

 Route::group(["middleware"=>["auth:sanctum"]],function(){
    
    // Routes related to reports

    Route::get("/initialStatistic",[HomeController::class, 'SummaryStatistic'])->name("summarystatistic");


    Route::post('/reports', [ReportController::class, 'create'])->name("addStudentsReport");
    Route::get('/reports', [ReportController::class, 'index'])->name("getStudentsReport");

    // Route to create a teacher
    Route::post('/teachers', [TeacherController::class, 'create']);
    Route::post('/teachersAttendance', [TeacherController::class, 'newAttendance'])->name('newTeacherAttendance');
    Route::get('/teacherAttendanceList',[TeacherController::class, 'teacherAttendanceList'])->name('teacherAttendanceList');
    Route::get('/teachersDailyAttendanceStatistic',[TeacherController::class, 'teachersDailyAttendanceStatistic'])->name('teachersDailyAttendanceStatistic');
    Route::post('/teachersInAttendance',[TeacherController::class,'checksteachersInAttendance'])->name("checksteachersInAttendance");
    Route::get('/teacherAttendanceDetail/{id}',[TeacherController::class,'teacherAttendanceDetail'])->name("teacherAttendanceDetail");
    Route::get("/schoolTeacherAttendance",[TeacherController::class,'schoolTeacherAttendance'])->name('schoolTeacherAttendance');
    // Routes related to school levels
    Route::get('/schoolLevels', [SchoolController::class, 'getClassLevels'])->name('getClassLevels');
    Route::get('/schoolLevelsOfSchool', [SchoolController::class, 'getClassLevelsOfSchool'])->name('getClassLevelsOfSchool');
    ROute::post('/updateschoolClass', [SchoolController::class, 'updateSchoolClass'])->name('schoolUpdateClass');
    Route::get('/SchoolLevel/{id}', [SchoolController::class,  'AllSchoolLevel'])->name('AllSchoolLevel');
    // Routes related to schools
    Route::post('/schools', [SchoolController::class, 'create'])->name('addNewSchool');
    Route::post('/updateschools', [SchoolController::class, 'updateSchool'])->name('updateSchoolInfo');
    Route::get('/deleteschoolinfo/{id}',[SchoolController::class, 'deleteschoolinfo'])->name('deleteschoolinfo');
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
    Route::get('/deletesectorinfo/{id}',[SectorControllers::class, 'deleteSector']);


    Route::get('/SEO_Users', [SectorControllers::class, 'AllSEO'])->name('getAllSEOUSERS');
    Route::post('/SEO_Users', [SectorControllers::class, 'addNewSEO'])->name('addNewSEO');
    Route::get('/SEO_AllStudents',[StudentController::class, 'SEO_AllStudents'])->name('SEO_AllStudents');
    Route::get('/SEO_AllStudentsByScool/{id}',[StudentController::class, 'SEO_AllStudentsBySchool'])->name('SEO_AllStudentsBySchool');
    Route::get('/SEO_SectorAttendance',[StudentController::class, 'SEO_SectorAttendance'])->name('SEO_SEO_SectorAttendance');
    Route::get('SEO-SectorStudentAttendance',[StudentController::class, 'SEO_StudentAttendance'])->name('seosectorstudentattendance');
    Route::post('/SEO_SectorTeacherAttendance',[TeacherController::class, 'SEO_SectorTeacherAttendance'])->name('SEO_SectorTeacherAttendance');
    Route::get('/SEO_StaffInSector',[SectorControllers::class, 'SEO_StaffInSector'])->name('SEO_StaffInSector');
    Route::post('/SEO_StaffBySchool',[SectorControllers::class, 'SEO_StaffbySchool'])->name('SEO_StaffbySchool');
   
    //Route::get('/')->name('SeoteachersDailyAttendancereport')
    // Routes related to students

    Route::post('/students', [StudentController::class, 'create'])->name('apiAddStudents');
    Route::post('/updatestudentinfo', [StudentController::class, 'updatestudentinfo']);
    Route::get('/students', [StudentController::class, 'index'])->name('getAllStudent');
    Route::get('/deletestudentinfo/{id}', [StudentController::class, 'deletestudentinfo'])->name('deleteStudent');
   
    Route::get('/studentsByClass', [StudentController::class, 'allStudentsInClass'])->name('getAllInStudent');
    Route::get('/checkstudentsInAttendance', [StudentController::class, 'checkIfStudentAttended'])->name('checkstudentsInAttendance');
  
    Route::post('/studentAttendance', [StudentController::class, 'studentsAttendance'])->name('studentsAttendance');
    Route::get('/studentAttendance', [StudentController::class, 'getStudentsAttendance'])->name('getStudentsAttendance');
    Route::get('/studentAttendanceDetail/{id}', [StudentController::class, 'studentsAttendanceDetail'])->name('getStudentAttendanceDetail');
    Route::get('/studentAttendanceScore', [StudentController::class, 'getAllStudentAttendanceScore'])->name('getStudentsAttendanceScore');
    Route::get('/studentAttendanceScoreInSchool/{id}', [StudentController::class, 'getAllStudentAttendanceScoreInSchool'])->name('getStudentsAttendanceScoreInSchool');
    Route::get('/schoolAttendance', [StudentController::class, 'getAllAttendanceBySchool'])->name('getAllAttendanceBySchool');
    Route::get('/schoolAttendanceList', [StudentController::class, 'getAllAttendanceByLevels'])->name('getAllAttendanceByLevels');
    Route::get('/schoolteacherAttendanceList', [TeacherController::class, 'teacherAttendanceBySchool'])->name('teacherAttendanceBySchool');


    // district attendteachersDailyAttendanceStatisticance start here --------------------------------------
    Route::get('/DEO_DistrictAttendance', [StudentController::class, 'DEO_DistrictAttendance'])->name('DEO_DistrictAttendance');
    Route::get('/DEO_SectorAttendance/{id}', [StudentController::class, 'DEO_SectorAttendance'])->name('DEO_SectorAttendance');
    Route::get('/DEO_SectorAttendanceBySector/{id}', [StudentController::class, 'DEO_SectorAttendanceByDate'])->name('DEO_SectorAttendanceBySector');
   
    Route::get('/DEO_SectorSchools/{id}', [StudentController::class, 'DEO_SchoolsInSector'])->name('DEO_SchoolsInSector');
    Route::get('/DEO_AllStudents', [StudentController::class, 'DEO_AllStudents'])->name('DEO_AllStudents');

    Route::get('/DEO_StudentAttendance', [StudentController::class, 'DEO_StudentAttendance'])->name('DEO_StudentAttendance');
    
    
    //DEO_DistrictAttendance
    
 
});