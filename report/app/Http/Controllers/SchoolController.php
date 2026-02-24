<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Http\Requests\SchoolRequest;

class SchoolController extends Controller
{
    public function index()
    {
        $schools = School::latest()->get();
        return view('schools.index', compact('schools'));
    }

    public function create()
    {
        return view('schools.create');
    }

    public function store(SchoolRequest $request) // <- Use SchoolRequest
    {
        School::create($request->validated());

        return redirect()
            ->route('schools.index')
            ->with('success', 'School has been added successfully');
    }

    public function show(School $school)
    {
        //
    }

    public function edit(School $school)
    {
        //
    }

    public function update(SchoolRequest $request, School $school)
    {
        $school->update($request->validated());

        return redirect()
            ->route('schools.index')
            ->with('success', 'School updated successfully');
    }

    public function destroy(School $school)
    {
        $school->delete();

        return redirect()
            ->route('schools.index')
            ->with('success', 'School deleted successfully');
    }
}