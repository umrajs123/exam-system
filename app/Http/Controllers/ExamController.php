<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function index()
    {
        $exams = Exam::all();  // Get all exams from the database
        return view('exams.index', compact('exams'));  // Return the exams to the view
    }

    // Show the form to create a new exam
    public function create()
    {
        return view('exams.create');  // Display form to create a new exam
    }

    // Store a new exam
    public function store(Request $request)
    {
        $exam = Exam::create($request->all());  // Create and store the new exam
        return redirect()->route('exams.index');  // Redirect to the list of exams
    }

    // Show a specific exam with its questions
    public function show(Exam $exam)
    {
        return view('exams.show', compact('exam'));  // Show the selected exam and its details
    }
}
