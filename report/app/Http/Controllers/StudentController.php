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

        
        $names = preg_split('/\r\n|\r|\n/', $request->studentNames);

        foreach ($names as $name) {
            $name = trim($name);
            if (!empty($name)) {
                $school->students()->create([
                    'name' => $name,
                    'course' => $request->studentCourse,
                    'office' => $request->studentOffice,
                    'contactNumber' => $request->studentContact,
                    'dateStart' => $request->dateStart,
                    'hoursOfDuty' => $request->hoursOfDuty,
                    'daysOfDuty' => $request->daysOfDuty,
                    'endOfDuty' => $request->endOfDuty,
                ]);
            }
        }

       
        return redirect()->back()->with('success', 'Students added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        return response()->json($student);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        $student->update([
            'name' => $request->name,
            'course' => $request->course,
            'office' => $request->office,
            'contactNumber' => $request->contactNumber,
            'dateStart' => $request->dateStart,
            'hoursOfDuty' => $request->hoursOfDuty,
            'daysOfDuty' => $request->daysOfDuty,
            'endOfDuty' => $request->endOfDuty
        ]);

        return redirect()->route('schools.show', $student->school_id)->with('success', 'Student updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();


        return redirect()->route('schools.show', $student->school_id);
    }
}