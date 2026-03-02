@extends('layouts.dashboardlayout')

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
                    <td></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>
    @include('modal.office.addOffice')
    

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
</script>
@endsection