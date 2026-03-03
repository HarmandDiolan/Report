@extends('layouts.dashboardlayout')
@section('title', 'Office Details')
@section('content')

<a href="{{ route('offices.index') }}" class="btn btn-light btn-sm">
    <i class="fa fa-arrow-left" aria-hidden="true"></i>
</a>

<div class="mb-3">
    <h3 class="fw-bold">{{ $office->name }}</h3>
</div>

<main class="p-4">
    <div class="card mb-4">
        <div class="card-body">
    <table id="showTable" class="table table-hover">
        <thead class="table-light">
            <tr>
                <th>Name</th>
                <th>Course</th>
                <th>School</th>
             
            </tr>
        </thead>
        <tbody>
            @foreach($office->students as $student)
            <tr>
                <td>{{ $student->name }}</td>
                <td>{{ $student->course }}</td>
                <td>{{ $student->school ? $student->school->name : '' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</div>
</main>

@

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
</script>
@endsection