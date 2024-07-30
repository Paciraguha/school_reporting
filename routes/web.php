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


Route::get('/schoolStaff', function () {
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

Route::get('/schoolStudentsReportDetail', function () {
    return view('DOs.dosStudentReport');
})->name('dosStudentReports');


Route::get('/schoolStudentsReport', function () {
    return view('DOs.schoolStudentReport');
})->name('schoolStudentReports');




Route::get('/dosStdudentInClass', function () {
    return view('DOs.newClassAttendance');
})->name('dosStudentsNewAttendance');

Route::get('/teachersNewAttendance', function () {
    return view('DOS.teacherAttendance');
})->name('teacherNewAttendance');

Route::get('/viewTeachersDailyAttendance', function () {
    return view('DOS.dailyTeacherAttendanceReport');
})->name('dailyTeacherAttendanceReport');

Route::get('/TeachersDailyAttendance', function () {
    return view('DOS.dailyTeacherAttendance');
})->name('dailyTeacherAttendance');

Route::get('/teacherAttendanceDetail/{id}', function () {
    return view('headTeacher.teacherAttendanceDetail');
})->name('teacherAttendanceDetail');


Route::get('/SEO-teacherAttendanceDetail/{id}', function () {
    return view('SEO.teacherAttendanceDetail');
})->name('teacherAttendanceDetail');

Route::get('/DEO-teacherAttendanceDetail/{id}', function () {
    return view('DEO.teacherAttendanceDetail');
})->name('teacherAttendanceDetail');

Route::get('/DEO-studentAttendancedetail/{id}', function () {
    return view('DEO.DEO-studentAttendancedetail');
})->name('DEO-studentAttendancedetail');


Route::get('/SEO-studentAttendancedetail/{id}', function () {
    return view('SEO.SEO-studendtAttendanceDetail');
})->name('SEO-studentAttendancedetail');


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

Route::get('/SectorStudentAttendanceDetail', function () {
    return view('SEO.SEO_SectorAttendance');
})->name('SEOSectorAttendance');

Route::get('/SectorStudentAttendance', function () {
    return view('SEO.Sector_StudentAttendanceAll');
})->name('SEOSectorAttendance');



Route::get('/SEO-SectorStaff', function () {
    return view('SEO.SEO_ViewSchoolStaff');
})->name('SEOViewSchoolStaff');

Route::get('/SEO-StaffBySchool/{id}', function () {
    return view('SEO.SEO_StaffBySchool');
})->name('SEO_StaffBySchool');


Route::get('/SEO-TeacherAttendanceByDate', function () {
    return view('SEO.SEO_TeacherAttendanceReportByDate');
})->name('SEO_TeacherAttendanceReport');


Route::get('/SEO-TeacherAttendanceReport', function () {
    return view('SEO.SEO_TeacherAttendanceReport');
})->name('SEO_TeacherAttendanceReport');
// Auth::routes()


// ------------------------------------------- District route start here ----------------------------------------------
Route::get('/SectorAttendanceReport', function () {
    return view('DEO.DEO_Attendance');
})->name('DEO_SectorAttendance');


Route::get('/StudentAttendanceReportByDate', function () {
    return view('DEO.DEO_AttendanceDetails');
})->name('DEO_AttendanceDetails');


Route::get('/SectorAttendanceReport/{id}', function () {
    return view('DEO.DEO_SectorAttendance');
})->name('DEO_AttendanceBySector');

Route::get('/SectorAttendanceReportByDate/{id}', function () {
    return view('DEO.DEO_SectorAttendanceByDate');
})->name('DEO_AttendanceBySectorByDate');






Route::get('/DistrictStudents', function () {
    return view('DEO.districtStudents');
})->name('DEO_districtStudents');

Route::get('/DistrictTeacherAttendance', function () {
    return view('DEO.DEO_teacherAttendamceReport');
})->name('DEO_teacherAttendamceReport');


Route::get('/school_student-attendance-report/{id}', function () {
    return view('DEO.DEO_SchoolAttendance');
})->name('DEO_school_attendance-report');

Route::get('/school_student-attendance-statistic/{id}', function () {
    return view('DEO.studentBySchool');
})->name('DEO_school_attendance-statistic');


// Route::get('/school_staff-list/{id}', function () {
//     return view('DEO.DEO_teacherAttendamceReport');
// })->name('DEO_school_staff-list');

Route::get('/school_staff-attendance-report/{id}', function () {
    return view('DEO.DEO_SchoolTeacherAttendance');
})->name('DEO_school_staff-attendance-report');

Route::get('/school_staff-attendance-statistic/{id}', function () {
    return view('DEO.viewStaffByschool');
})->name('DEO_school_staff-attendance-statistic');








Route::get('/login', function () {
    return view('welcome')->name("login");
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
