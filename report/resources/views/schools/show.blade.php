@extends('layouts.dashboardlayout')

@section('content')

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
                    <td>{{$student->office ? $student->office->name : ''}}</td>
                    <td>
                       <button class="btn btn-sm btn-primary viewtBtn"
                            data-id="{{ $student->id }}"
                            data-name="{{ $student->name }}"
                            data-course="{{ $student->course }}"
                            data-office="{{ $student->office ? $student->office->name : '' }}"
                            data-contact="{{ $student->contactNumber }}"
                            data-start="{{ $student->dateStart }}"
                            data-end="{{ $student->endOfDuty }}"
                            data-hours="{{ $student->hoursOfDuty }}"
                            data-days="{{ $student->daysOfDuty }}"
                            data-bs-toggle="modal"
                            data-bs-target="#showStudentModal">
                            <i class="fa fa-eye"></i>
                        </button>
                        <button class="btn btn-sm btn-primary editBtn"
                            data-id="{{ $student->id }}"
                            data-name="{{ $student->name }}"
                            data-course="{{ $student->course }}"
                            data-office="{{ $student->office_id }}"
                            data-contact="{{ $student->contactNumber }}"
                            data-start="{{ $student->dateStart }}"
                            data-end="{{ $student->endOfDuty }}"
                            data-hours="{{ $student->hoursOfDuty }}"
                            data-days="{{ $student->daysOfDuty }}"
                            data-bs-toggle="modal"
                            data-bs-target="#editStudentModal">
                            <i class="fas fa-edit"></i>
                        </button>
                        <form action="{{ route('students.destroy', $student->id) }}" id="student-form-{{$student->id}}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="button" 
                                    class="btn btn-sm btn-danger deleteBtn" 
                                    data-id="{{ $student->id }}" 
                                    data-name="{{ $student->name }}" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#myModal">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </main>

    @include('modal.addStudent')
    @include('modal.editStudent')
    @include('modal.student.show')
    @include('modal.student.delete')
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
        let officeId = this.dataset.office
        let contact = this.dataset.contact;
        let dateStart = this.dataset.start;
        let endOfDuty = this.dataset.end;
        let hoursOfDuty = this.dataset.hours;
        let daysOfDuty = this.dataset.days;

        document.getElementById('editStudentForm').action = "/students/" + id;

        document.getElementById('edit_name').value = name;
        document.getElementById('edit_course').value = course;
        document.getElementById('edit_office').value = officeId;
        document.getElementById('edit_contact').value = contact;
        document.getElementById('edit_start').value = dateStart;
        document.getElementById('edit_end').value = endOfDuty;
        document.getElementById('edit_hours').value = hoursOfDuty;
        document.getElementById('edit_days').value = daysOfDuty;
    });
});
</script>
<script>
document.addEventListener("DOMContentLoaded", function () {

    const buttons = document.querySelectorAll(".viewtBtn");

    buttons.forEach(button => {
        button.addEventListener("click", function () {

            document.getElementById("show_name").textContent = this.dataset.name;
            document.getElementById("show_course").textContent = this.dataset.course;
            document.getElementById("show_office").textContent = this.dataset.office;
            document.getElementById("show_contact").textContent = this.dataset.contact;
            document.getElementById("show_start").textContent = this.dataset.start;
            document.getElementById("show_end").textContent = this.dataset.end;
            document.getElementById("show_hours").textContent = this.dataset.hours;
            document.getElementById("show_days").textContent = this.dataset.days;

        });
    });

});
</script>

@endsection