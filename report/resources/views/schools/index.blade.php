@extends('layouts.dashboardlayout')

@section('content')
<main class="p-4">

    <h2>Schools List</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addModal">
        Add School
    </button>

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

    @include('modal.create') <!-- your modal -->

</main>
@endsection

@section('scripts')
<script>
    // Initialize Simple-DataTables with search, sorting, and pagination
    const table = document.querySelector("#schoolsTable");
    if (table) {
        new simpleDatatables.DataTable(table, {
            searchable: true,   // enable search box
            fixedHeight: false, // adjust table height automatically
            sortable: true,     // enable column sorting
            perPage: 5,         // 5 rows per page
            perPageSelect: [5, 10, 20, 50] // dropdown for page length
        });
    }
</script>
@endsection