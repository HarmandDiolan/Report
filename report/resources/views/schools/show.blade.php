@extends('layouts.dashboardlayout')

@section('content')
    <a href="{{route('schools.index')}}" class="btn btn-light btn-sm"><i class="fa fa-arrow-left" " aria-hidden="true"></i></a>

   <div class="d-flex justify-content-end mb-3">
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addStudentModal">
            Add Student
        </button>
    </div>

    <main class="p-4">
        <table id="showTable" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Course</th>
                <th>Office</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($school->students as $student)
                <tr>
                    <td>{{$student->name}}</td>
                    <td>{{$student->course}}</td>
                    <td>{{$student->office}}</td>
                    <td>
                        <a href="{{ route('students.edit', $student->id) }}" class="btn btn-sm btn-danger"><i class="fas fa-edit"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </main>

    @include('modal.addStudent')
@endsection


