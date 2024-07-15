<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/newStaff', function () {
    return view('auth.register');
})->name('newStaff');

Route::get('/students', function () {
    return view('students');
})->name('students');

Route::get('/addStudents', function () {
    return view('addStudents');
})->name('addStudents');
/*
Route::get('/students', function () {
    return view('RegisterStudent');
})->name('addStudents');
*/

Route::get('/StudentReports', function () {
    return view('studentReport');
})->name('allForReports');

Route::get('/addSchool', function () {
    return view('Deo.addSchools');
})->name('addSchool');

Route::get('/addSchoolClass', function () {
    return view('addClass');
})->name('addSchoolClass');

Route::get('/addSectors', function () {
    return view('Deo.addSectors');
})->name('addSector');


Route::get('/schoolStaffList', function () {
    return view('Deo.viewSchoolStaff');
})->name('schoolStaffList');


Route::get('/assignClassLevels', function () {
    return view('teachers');
})->name('assignClassToTeacher');

Route::get('/classAttendance', function () {
    return view('classAttendance');
})->name('studentAttendance');

Route::get('/classAttendanceReport', function () {
    return view('classReport');
})->name('getClassAttendanceReport');


Route::get('/classAttendanceStatistic', function () {
    return view('studentAttendanceStatistic');
})->name('studentAttendanceStatistic');


Route::get('/classAttendanceDetail/{id}', function () {
    return view('studentsAttendanceDetail');
})->name('studentAttendanceDetail');


Route::get('/headTeacher', function () {
    return view('headTeacherHome');
})->name('headTeacherHome');


Route::get('/TeacherDailyAttendance', function () {
    return view('headTeacher.teacherDailyAttendance');
})->name('teacherDailyAttendance');

Route::get('/viewTeachersAttendanceReport', function () {
    return view('headTeacher.teachersAttendanceReport');
})->name('teachersAttendanceReport');


// dos api for web page view ------------------------------------------------

Route::get('/dos', function () {
    return view('DOs.dos_welcome');
})->name('schooldosindex');

Route::get('/studentinclass/{id}', function () {
    return view('DOS.dosViewStudent');
})->name('dosViewStudents');


Route::get('/studentDetail/{id}', function () {
    return view('DOS.studentDetailDos');
})->name('studentDetailDos');

Route::get('/dosStudents', function () {
    return view('DOs.dosClass');
})->name('schooldosclass');

Route::get('/dosStudentsReport', function () {
    return view('DOs.dosStudentReport');
})->name('dosStudentReports');

Route::get('/dosStdudentInClass', function () {
    return view('DOs.newClassAttendance');
})->name('dosStudentsNewAttendance');

Route::get('/teachersNewAttendance', function () {
    return view('DOS.teacherAttendance');
})->name('teacherNewAttendance');

Route::get('/viewTeachersDailyAttendance', function () {
    return view('DOS.dailyTeacherAttendanceReport');
})->name('dailyTeacherAttendanceReport');




// SEO routes for web interface

Route::get('/SEO', function () {
    return view('SEO.SEO_Welcome');
})->name('SEO_Welcome');

Route::get('/SEO-Schools', function () {
    return view('SEO.SEO_School');
})->name('SEO_School');

Route::get('/SEO-SchoolsAttendance/{id}', function () {
    return view('SEO.SEO_SchoolAttendance');
})->name('SEO_SchoolAttendance');

Route::get('/SEO-SchoolsAttendance', function () {
    return view('SEO.SEO_Students');
})->name('SEO_Students');

Route::get('/SEO-SchoolDailyAttendance/{id}', function () {
    return view('SEO.SEO_SchoolDailyAttendance');
})->name('SchoolDailyAttendance');

Route::get('/SEO-SectorAttendance', function () {
    return view('SEO.SEO_SectorAttendance');
})->name('SEOSectorAttendance');

Route::get('/SEO-SectorStaff', function () {
    return view('SEO.SEO_ViewSchoolStaff');
})->name('SEOViewSchoolStaff');

Route::get('/SEO-StaffBySchool/{id}', function () {
    return view('SEO.SEO_StaffBySchool');
})->name('SEO_StaffBySchool');


Route::get('/SEO-TeacherAttendenceReport', function () {
    return view('SEO.SEO_TeacherAttendanceReport');
})->name('SEO_TeacherAttendanceReport');
// Auth::routes()


// ------------------------------------------- District route start here ----------------------------------------------
Route::get('/SectorAttendanceReport', function () {
    return view('DEO.DEO_Attendance');
})->name('DEO_SectorAttendance');

Route::get('/SectorAttendanceReport/{id}', function () {
    return view('DEO.DEO_SectorAttendance');
})->name('DEO_AttendanceBySector');

Route::get('/DistrictStudents', function () {
    return view('DEO.districtStudents');
})->name('DEO_districtStudents');

Route::get('/DistrictTeacherAttendance', function () {
    return view('DEO.DEO_teacherAttendamceReport');
})->name('DEO_teacherAttendamceReport');





Route::get('/login', function () {
    return view('welcome')->name("login");
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
