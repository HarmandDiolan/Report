@extends('layouts.dashboardlayout')
@section('title', 'Office List')
@section('content')
<main class="p-4">
    <h2>Office List</h2>
    <div class="d-flex justify-content-end mb-3">
        <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addModal">
            Add Office
        </button>
    </div>
    <div class="card mb-4">
        <div class="card-body">
        <table id="schoolsTable" class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th>Name</th>
                    <th>Applicants</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($offices as $office)
                <tr>
                    <td>{{ $office->name}}</td>
                    <td>{{ $office->students_count}}</td>
                    <td>
                        <a href="{{route ('offices.show', $office->id)}}" class="btn btn-primary btn-sm">
                            <i class="fa fa-eye" aria-hidden="true"></i>

                        </a>
                        <button type="button" class="btn btn-sm btn-danger deleteBtn"
                        data-id="{{ $office->id }}"
                        data-name="{{ $office->name }}"
                        data-bs-toggle="modal"
                        data-bs-target="#deleteModal">
                            <i class="fa fa-trash"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>
    @include('modal.office.addOffice')
    @include('modal.office.deleteOffice')

</main>
@endsection

@section('scripts')
<script>
    
    const table = document.querySelector("#schoolsTable");
    if (table) {
        new simpleDatatables.DataTable(table, {
            searchable: true,   
            fixedHeight: false, 
            sortable: true,     
            perPage: 5,         
            perPageSelect: [5, 10, 20, 50]
        });
    }

     document.addEventListener("DOMContentLoaded", function () {
        const deleteButtons = document.querySelectorAll('.deleteBtn');
        const deleteForm = document.getElementById('deleteForm');
        const modalText = document.getElementById('modal-text');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const officeId = this.dataset.id;
                const officeName = this.dataset.name;

                // Update the form action dynamically
                deleteForm.action = `/offices/${officeId}`;
                modalText.textContent = `Do you really want to delete office "${officeName}"? This process cannot be undone.`;
            });
        });
    });
</script>
@endsection