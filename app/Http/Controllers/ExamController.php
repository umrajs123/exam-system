<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Question;
use App\Models\QuestionOption;
use App\Models\Subject;
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
        // Fetch all subjects
    $subjects = Subject::all();
        return view('exams.create', compact('subjects'));  // Display form to create a new exam
    }

    // Store a new exam
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'start_time' => 'required|date',
            'duration' => 'required|integer',
            'passing_marks' => 'required|integer',
            'subject_id' => 'nullable|exists:subjects,id',
            'new_subject_name' => 'nullable|string', // For the new subject name if "Add New" is selected
            'questions' => 'required|array',
            'questions.*.question_text' => 'required|string',
            'questions.*.options' => 'required|array',
            'questions.*.subject_id' => 'nullable|exists:subjects,id',
        ]);

        // Create the exam
        $exam = Exam::create([
            'name' => $validated['name'],
            'start_time' => $validated['start_time'],
            'duration' => $validated['duration'],
            'passing_marks' => $validated['passing_marks'],
        ]);

        // If a new subject name was provided, create it and use its id
        $subjectIdForQuestions = $validated['subject_id'] ?? null;
        if (!empty($validated['new_subject_name'])) {
            $newSubject = Subject::create(['name' => $validated['new_subject_name']]);
            $subjectIdForQuestions = $newSubject->id;
        }

        // Create questions and options
        foreach ($validated['questions'] as $questionData) {
            // Use per-question subject if provided, otherwise fallback to the global/new subject
            $subjectId = $questionData['subject_id'] ?? $subjectIdForQuestions;

            if (empty($subjectId)) {
                return back()->withErrors(['subject' => 'Subject is required for each question or select a global subject.'])->withInput();
            }

            $question = Question::create([
                'exam_id' => $exam->id,
                'subject_id' => $subjectId, // Store the determined subject_id
                'question_text' => $questionData['question_text'],
                'difficulty_level' => $questionData['difficulty_level'] ?? 1, // Set default to 1 if not provided
            ]);

            foreach ($questionData['options'] as $index => $optionText) {
                $isCorrect = ($index === 0);  // Adjust if you want to make the first option always correct

                QuestionOption::create([
                    'question_id' => $question->id,
                    'option_text' => $optionText,
                    'is_correct' => $isCorrect,
                ]);
            }
        }

        return redirect()->route('exams.index')->with('success', 'Exam created successfully');
    }



    // Show a specific exam with its questions
    public function show(Exam $exam)
    {
        return view('exams.show', compact('exam'));  // Show the selected exam and its details
    }
}
