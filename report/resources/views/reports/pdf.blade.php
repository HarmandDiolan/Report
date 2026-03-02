<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Students Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            font-size: 10px;
        }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th {
            background-color: #4CAF50;
            color: white;
            padding: 8px;
            text-align: left;
            border: 1px solid #ddd;
        }
        td {
            padding: 8px;
            border: 1px solid #ddd;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 9px;
            color: #666;
        }
    </style>
</head>
<body>
    <h2>Students Report</h2>
    <p style="text-align: center; color: #666; margin-bottom: 15px;">Generated on {{ \Carbon\Carbon::now()->format('F j, Y H:i:s') }}</p>
    
    <table>
        <thead>
            <tr>
                <th>School</th>
                <th>Contact Number</th>
                <th>Course</th>
                <th>Applicants</th>
                <th>Office</th>
                <th>Hours</th>
                <th>Start Date</th>
            </tr>
        </thead>
        <tbody>
            @php
                $rowCount = 0;
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
                        $rowCount++;
                    @endphp
                    <tr @if($rowCount % 2 == 0) style="background-color: #f2f2f2;" @endif>
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
    
    <div class="footer">
        <p>This is an automated report. For more information, please contact the administrator.</p>
    </div>
</body>
</html>
