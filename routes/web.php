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

Route::get('/students', function () {
    return view('viewStudents');
})->name('viewStudents');
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


Route::get('/classAttendanceReport', function () {
    return view('classReport');
})->name('getClassAttendanceReport');



Route::get('/headTeacher', function () {
    return view('headTeacherHome');
})->name('headTeacherHome');





// Auth::routes();

Route::get('/login', function () {
    return view('welcome');
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
