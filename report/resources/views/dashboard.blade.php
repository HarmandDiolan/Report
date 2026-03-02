@extends('layouts.dashboardlayout')

@section('pageTitle','Dashboard')

@section('content')
<main class="p-4">
    <div class="row mb-4" style="border: none;">
        <div class="col-md-6">
            
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('report.export.csv') }}" class="btn btn-success btn-sm me-2" style="border: none;">
                <i class="fas fa-file-csv"></i> Download CSV
            </a>
            <a href="{{ route('report.export.pdf') }}" class="btn btn-danger btn-sm" style="border: none;">
                <i class="fas fa-file-pdf"></i> Download PDF
            </a>
        </div>
    </div>

    <table id="studentTable" class="table table-bordered table-striped">
        <thead>
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
                        <tr>
                            @if($first)
                                <td rowspan="{{ $rowspan }}">{{ $schoolName }}</td>
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
</main>
@endsection