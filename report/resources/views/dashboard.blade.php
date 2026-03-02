@extends('layouts.dashboardlayout')

@section('pageTitle','Dashboard')

@section('content')
<main class="p-4">

    {{-- Dashboard Cards --}}
    <div class="row mb-4">
        @php
            $totalSchools = $students->groupBy('school_id')->count();
            $totalApplicants = $students->count();
            $totalCourses = $students->groupBy('course')->count();
            $totalOffices = $students->groupBy('office_id')->count();
        @endphp

        <div class="col-md-3 mb-3">
            <div class="card shadow-sm border-100 text-center p-3">
                <div class="card-body">
                    <h5 class="card-title text-primary">Total Schools</h5>
                    <p class="card-text display-6 fw-bold">{{ $totalSchools }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card shadow-sm border-100 text-center p-3">
                <div class="card-body">
                    <h5 class="card-title text-success">Total Applicants</h5>
                    <p class="card-text display-6 fw-bold">{{ $totalApplicants }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card shadow-sm border-100 text-center p-3">
                <div class="card-body">
                    <h5 class="card-title text-warning">Total Courses</h5>
                    <p class="card-text display-6 fw-bold">{{ $totalCourses }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card shadow-sm border-100 text-center p-3">
                <div class="card-body">
                    <h5 class="card-title text-danger">Total Offices</h5>
                    <p class="card-text display-6 fw-bold">{{ $totalOffices }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Header Buttons --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">Student Dashboard</h3>
        <div>
            <a href="{{ route('report.export.csv') }}" class="btn btn-success btn-sm me-2 shadow-sm">
                <i class="fas fa-file-csv"></i> Download CSV
            </a>
            <a href="{{ route('report.export.pdf') }}" class="btn btn-danger btn-sm shadow-sm">
                <i class="fas fa-file-pdf"></i> Download PDF
            </a>
        </div>
    </div>

    {{-- Table --}}
    <div class="table-responsive shadow-sm rounded">
        <table id="studentTable" class="table table-striped table-hover align-middle mb-0">
            <thead class="table-dark">
                <tr>
                    <th>SCHOOL</th>
                    <th>CONTACT NUMBER</th>
                    <th>COURSE</th>
                    <th># of Applicants</th>
                    <th>OFFICE</th>
                    <th>HOURS</th>
                    <th>START</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $schoolGroups = $students->groupBy('school_id');
                @endphp
                @foreach($schoolGroups as $schoolId => $schoolStudents)
                    @php
                        $schoolName = $schoolStudents->first()->school->name ?? '-';
                        $courseGroups = $schoolStudents->groupBy('course');
                        $rowspan = $courseGroups->count();
                        $first = true;
                    @endphp
                    @foreach($courseGroups as $course => $courseStudents)
                        @php
                            $firstStudent = $courseStudents->first();
                            $applicantsCount = $courseStudents->count();
                            $officeName = $firstStudent->office->name ?? '-';
                            $contactNumber = $firstStudent->contactNumber ?? '-';
                            $hoursOfDuty = $firstStudent->hoursOfDuty ?? '-';
                            $dateStart = $firstStudent->dateStart ? \Carbon\Carbon::parse($firstStudent->dateStart)->format('F j, Y') : '-';
                        @endphp
                        <tr class="table-light">
                            @if($first)
                                <td rowspan="{{ $rowspan }}" class="fw-bold text-primary">{{ $schoolName }}</td>
                                @php $first = false; @endphp
                            @endif
                            <td>{{ $contactNumber }}</td>
                            <td>{{ $course }}</td>
                            <td>{{ $applicantsCount }}</td>
                            <td>{{ $officeName }}</td>
                            <td>{{ $hoursOfDuty }}</td>
                            <td>{{ $dateStart }}</td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>

</main>
@endsection