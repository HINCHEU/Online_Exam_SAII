<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade as PDF;


use App\Models\Student; // Replace with your model

class PDFController extends Controller
{
    public function generatePDF()
    {
        $students = Student::all(); // Fetch data from database

        $pdf = PDF::loadView('pdf.student_scores', compact('students'));

        return $pdf->download('student_scores.pdf');
    }
}
