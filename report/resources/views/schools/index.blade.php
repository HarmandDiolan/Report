@extends('layouts.dashboardlayout')

@section('content')
<main class="p-4">

    <h2>Schools List</h2>

   @if(session('success'))
        <div id="flash-success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    <div class="d-flex justify-content-end mb-3">
        <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addModal">
            Add School
        </button>
    </div>
    
    <table id="schoolsTable" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($schools as $school)
            <tr>
                <td>{{ $school->name }}</td>
                <td>
                    <a href="{{ route('schools.show', $school->id) }}" class="btn btn-primary btn-sm">
                        <i class="fa fa-eye" aria-hidden="true"></i>
                    </a>        
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    @include('modal.create')
    

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