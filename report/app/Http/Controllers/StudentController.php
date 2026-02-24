<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\School;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;

class StudentController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request)
    {
        $school = School::findOrFail($request->school_id);

        // Split names by new lines (handles Windows, Mac, Linux)
        $names = preg_split('/\r\n|\r|\n/', $request->studentNames);

        foreach ($names as $name) {
            $name = trim($name);
            if (!empty($name)) {
                $school->students()->create([
                    'name' => $name,
                    'course' => $request->studentCourse,
                    'office' => $request->studentOffice,
                ]);
            }
        }

        // Return only AFTER the loop finishes
        return redirect()->back()->with('success', 'Students added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        //
    }
}
