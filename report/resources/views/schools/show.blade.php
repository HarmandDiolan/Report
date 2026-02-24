@extends('layouts.dashboardlayout')

@section('content')

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    <a href="{{route('schools.index')}}" class="btn btn-light btn-sm"><i class="fa fa-arrow-left" " aria-hidden="true"></i></a>

   <div class="d-flex justify-content-end mb-3">
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addStudentModal">
            Add Student
        </button>
    </div>

    <div class="mb-3">
        <h3 class="fw-bold">{{$school->name}}</h3>
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
                        <button class="btn btn-sm btn-primary editBtn"
                                data-id="{{ $student->id }}"
                                data-name="{{ $student->name }}"
                                data-course="{{ $student->course }}"
                                data-office="{{ $student->office }}"
                                data-bs-toggle="modal"
                                data-bs-target="#editStudentModal">
                            <i class="fas fa-edit"></i>
                        </button>
                        <a href="{{ route('students.edit', $student->id) }}" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </main>

    @include('modal.addStudent')
    @include('modal.editStudent')
@endsection

@section('scripts')
<script>
    
    const table = document.querySelector("#showTable");
    if (table) {
        new simpleDatatables.DataTable(table, {
            searchable: true,   
            fixedHeight: false, 
            sortable: true,     
            perPage: 5,         
            perPageSelect: [5, 10, 20, 50]
        });
    }
</script>
<script>
    document.querySelectorAll('.editBtn').forEach(button => {
        button.addEventListener('click', function () {

            let id = this.dataset.id;
            let name = this.dataset.name;
            let course = this.dataset.course;
            let office = this.dataset.office;

            // Set form action dynamically
            document.getElementById('editStudentForm').action = "/students/" + id;

            // Fill inputs
            document.getElementById('edit_name').value = name;
            document.getElementById('edit_course').value = course;
            document.getElementById('edit_office').value = office;
        });
    });
</script>

@endsection


