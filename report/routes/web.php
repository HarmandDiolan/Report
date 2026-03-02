<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\ReportController;
use App\Models\School;
use App\Models\Office;
use App\Models\Student;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {

     $students = Student::with('school', 'office')->get();
    return view('dashboard', compact('students'));

})->name('dashboard');

// Report export routes
Route::get('/report/export-csv', [ReportController::class, 'exportCsv'])->name('report.export.csv');
Route::get('/report/export-pdf', [ReportController::class, 'exportPdf'])->name('report.export.pdf');

Route::resource('schools', SchoolController::class);
Route::resource('students', StudentController::class);
Route::resource('offices', OfficeController::class);