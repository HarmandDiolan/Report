@extends('layouts.dashboardlayout')

@section('content')

<main class="p-4">
    <div class="card mb-4">
        <!-- <div class="d-flex justify-content-end p-3">
            <button type="button" class="btn btn-success btn-lg" data-bs-toggle="modal" data-bs-target="#addModal" >Add</button>
        </div> -->
        
    </div>
    <div class="card mb-4">
        
        <div class="card-body">
        </div>
    </div>
</main>

@include('modal.create')
@endsection