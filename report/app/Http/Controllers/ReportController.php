<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Response;

class ReportController extends Controller
{
    /**
     * Export dashboard data as CSV
     */
    public function exportCsv(): Response
    {
        $students = Student::with('school', 'office')->get();
        
        $csv = $this->generateCsv($students);
        
        return response($csv, 200)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename="students_report_' . date('Y-m-d_H-i-s') . '.csv"');
    }

    /**
     * Export dashboard data as PDF
     */
    public function exportPdf()
    {
        $students = Student::with('school', 'office')->get();
        $schoolGroups = $students->groupBy('school_id');
        
        // Create PDF content directly
        $html = view('reports.pdf', compact('schoolGroups', 'students'))->render();
        
        // Use mPDF or generate HTML to PDF
        $filename = 'students_report_' . date('Y-m-d_H-i-s') . '.pdf';
        
        try {
            // Try using DomPDF through direct instantiation
            $dompdf = new \Dompdf\Dompdf();
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();
            
            return response($dompdf->output(), 200)
                ->header('Content-Type', 'application/pdf')
                ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
        } catch (\Exception $e) {
            // Fallback: return the printable view
            return view('reports.pdf-print', compact('schoolGroups', 'students'));
        }
    }

    /**
     * Generate CSV string from students data
     */
    private function generateCsv($students): string
    {
        $output = fopen('php://memory', 'r+');
        
        // Add CSV headers
        fputcsv($output, ['School', 'Contact Number', 'Course', 'Number of Applicants', 'Office', 'Hours of Duty', 'Start Date']);
        
        // Group by school for better organization
        $schoolGroups = $students->groupBy('school_id');
        
        foreach ($schoolGroups as $schoolId => $schoolStudents) {
            $schoolName = $schoolStudents->first()->school->name ?? '-';
            $courseGroups = $schoolStudents->groupBy('course');
            $isFirstCourse = true;
            
            foreach ($courseGroups as $course => $courseStudents) {
                $firstStudent = $courseStudents->first();
                $applicantsCount = $courseStudents->count();
                $officeName = $firstStudent->office->name ?? '-';
                $contactNumber = $firstStudent->contactNumber ?? '-';
                $hoursOfDuty = $firstStudent->hoursOfDuty ?? '-';
                $dateStart = $firstStudent->dateStart ? \Carbon\Carbon::parse($firstStudent->dateStart)->format('F j, Y') : '-';
                
                // Show school name only on first course, mimicking rowspan appearance
                $displaySchoolName = $isFirstCourse ? $schoolName : '';
                
                fputcsv($output, [
                    $displaySchoolName,
                    $contactNumber,
                    $course,
                    $applicantsCount,
                    $officeName,
                    $hoursOfDuty,
                    $dateStart
                ]);
                
                $isFirstCourse = false;
            }
        }
        
        rewind($output);
        $csv = stream_get_contents($output);
        fclose($output);
        
        return $csv;
    }
}
