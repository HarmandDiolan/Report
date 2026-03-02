<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Students Report - Printable</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            padding: 20px;
            font-size: 13px;
        }
        
        .print-container {
            background-color: white;
            padding: 30px;
            max-width: 1200px;
            margin: 0 auto;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border: 3px solid #333;
            border-radius: 8px;
        }
        
        .print-header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 20px;
        }
        
        .print-header h2 {
            color: #333;
            margin-bottom: 10px;
            font-size: 28px;
        }
        
        .print-header p {
            color: #666;
            font-size: 11px;
        }
        
        .print-controls {
            margin-bottom: 20px;
            text-align: center;
        }
        
        .print-controls button {
            padding: 10px 30px;
            font-size: 14px;
            background-color: #0066cc;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin: 0 5px;
        }
        
        .print-controls button:hover {
            background-color: #0052a3;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        
        th {
            background-color: #4CAF50;
            color: white;
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
            font-weight: bold;
        }
        
        td {
            padding: 10px;
            border: 1px solid #ddd;
        }
        
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        
        tr:hover {
            background-color: #f0f0f0;
        }
        
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            font-size: 11px;
            color: #666;
        }
        
        @media print {
            body {
                background-color: white;
                padding: 0;
            }
            
            .print-container {
                box-shadow: none;
                padding: 0;
                max-width: 100%;
            }
            
            .print-controls {
                display: none;
            }
            
            .print-header {
                border-bottom: 1px solid #000;
            }
            
            table {
                margin-top: 10px;
            }
            
            th {
                background-color: #4CAF50 !important;
                color: white !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
            
            tr:nth-child(even) {
                background-color: #f9f9f9 !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>
</head>
<body>
    <div class="print-container">
        <div class="print-header">
            <h2>Students Report</h2>
            <p>Generated on {{ \Carbon\Carbon::now()->format('F j, Y H:i:s') }}</p>
        </div>
        
        <div class="print-controls">
            <button onclick="window.print()">🖨️ Print</button>
        </div>
        
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
                                <td rowspan="{{ $rowspan }}"><strong>{{ $schoolName }}</strong></td>
                                @php $first = false; @endphp
                            @endif
                            <td>{{ $contactNumber }}</td>
                            <td>{{ $course }}</td>
                            <td class="text-center">{{ $applicantsCount }}</td>
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
    </div>
</body>
</html>
