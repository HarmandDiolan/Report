<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Office;
use App\Http\Requests\StoreOfficeRequest;
use App\Http\Requests\UpdateOfficeRequest;

class OfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $offices = Office::withCount('students')->latest()->get();
        return view('offices.index', compact('offices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('offices.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOfficeRequest $request)
    {
        Office::create($request->validated());

        return redirect()
            ->route('offices.index')
            ->with('success', 'Office has been added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Office $office)
    {
        $offices = Office::withCount('students')->get();
        return view('offices.index', compact('offices'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Office $office)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOfficeRequest $request, Office $office)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Office $office)
    {
        //
    }
}
