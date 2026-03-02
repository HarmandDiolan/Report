<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AuthController;
use App\Models\School;
use App\Models\Office;
use App\Models\Student;

Route::get('/', function () {
    return auth()->check() ? redirect()->route('dashboard') : view('welcome');
});

// authentication routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', function () {
    $students = Student::with('school', 'office')->get();
    return view('dashboard', compact('students'));
})->name('dashboard')->middleware('auth');

// Report export routes
Route::middleware('auth')->group(function () {
    Route::get('/report/export-csv', [ReportController::class, 'exportCsv'])->name('report.export.csv');
    Route::get('/report/export-pdf', [ReportController::class, 'exportPdf'])->name('report.export.pdf');

    Route::resource('schools', SchoolController::class);
    Route::resource('students', StudentController::class);
    Route::resource('offices', OfficeController::class);
});