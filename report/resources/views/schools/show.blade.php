@extends('layouts.dashboardlayout')

@section('content')

<a href="{{ route('schools.index') }}" class="btn btn-light btn-sm">
    <i class="fa fa-arrow-left" aria-hidden="true"></i>
</a>

<div class="d-flex justify-content-end mb-3">
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addStudentModal">
        Add Student
    </button>
</div>

<div class="mb-3">
    <h3 class="fw-bold">{{ $school->name }}</h3>
</div>

<main class="p-4">
    <div class="card mb-4">
        <div class="card-body">
    <table id="showTable" class="table table-hover">
        <thead class="table-light">
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
                <td>{{ $student->name }}</td>
                <td>{{ $student->course }}</td>
                <td>{{ $student->office ? $student->office->name : '' }}</td>
                <td>
                    <!-- View Button -->
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

                    <!-- Edit Button -->
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

                    <!-- Delete Button -->
                    <button type="button" 
                            class="btn btn-sm btn-danger deleteBtn"
                            data-id="{{ $student->id }}"
                            data-name="{{ $student->name }}"
                            data-bs-toggle="modal"
                            data-bs-target="#myModal">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</div>
</main>

<!-- Include Modals -->
@include('modal.addStudent')
@include('modal.editStudent')
@include('modal.student.show')
@include('modal.student.delete') <!-- Your delete modal -->

@endsection

@section('scripts')
<script>
    // Initialize DataTable
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

    // Edit button
    document.querySelectorAll('.editBtn').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.dataset.id;
            document.getElementById('editStudentForm').action = "/students/" + id;

            document.getElementById('edit_name').value = this.dataset.name;
            document.getElementById('edit_course').value = this.dataset.course;
            document.getElementById('edit_office').value = this.dataset.office;
            document.getElementById('edit_contact').value = this.dataset.contact;
            document.getElementById('edit_start').value = this.dataset.start;
            document.getElementById('edit_end').value = this.dataset.end;
            document.getElementById('edit_hours').value = this.dataset.hours;
            document.getElementById('edit_days').value = this.dataset.days;
        });
    });

    // View button
    document.querySelectorAll('.viewtBtn').forEach(button => {
        button.addEventListener('click', function () {
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

    // Delete button
    document.addEventListener("DOMContentLoaded", function () {
        const deleteButtons = document.querySelectorAll('.deleteBtn');
        const deleteForm = document.getElementById('deleteForm');
        const modalText = document.getElementById('modal-text');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const studentId = this.dataset.id;
                const studentName = this.dataset.name;

                // Update the form action dynamically
                deleteForm.action = `/students/${studentId}`;
                modalText.textContent = `Do you really want to delete student "${studentName}"? This process cannot be undone.`;
            });
        });
    });
</script>
@endsection