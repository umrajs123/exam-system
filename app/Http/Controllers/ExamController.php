<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Question;
use App\Models\QuestionOption;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        // If a search term is provided, filter the exams
        if ($search) {
            $exams = Exam::where('name', 'like', '%' . $search . '%')->get();
        } else {
            $exams = Exam::all();
        }

        $teacherCount = User::where('role', 'teacher')->count();
        $subjects = Subject::all();

        return view('exams.index', compact('exams', 'teacherCount', 'subjects'));
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
            'questions.*.options.*' => 'nullable|string',
            'questions.*.correct_option' => 'nullable|string',
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

            // Determine selected option index if provided (value like "0", "1", etc.)
            $correctIndex = $questionData['correct_option'] ?? null;
            if ($correctIndex !== null) {
                $correctIndex = (int) $correctIndex;
            }

            // Debug logging
            \Log::info('Question options processing', [
                'correct_option_raw' => $questionData['correct_option'] ?? 'NOT SET',
                'correctIndex' => $correctIndex,
                'options' => $questionData['options'],
            ]);

            // Iterate original options so correctness is determined against original indexes.
            foreach ($questionData['options'] as $origIndex => $optionText) {
                if (is_null($optionText) || trim((string) $optionText) === '') {
                    continue;
                }

                // Compare the original option index (0-based) to the posted value
                $isCorrect = $correctIndex !== null && $origIndex === $correctIndex;

                \Log::info('Creating option', [
                    'option_text' => $optionText,
                    'origIndex' => $origIndex,
                    'correctIndex' => $correctIndex,
                    'isCorrect' => $isCorrect,
                    'isCorrect_type' => gettype($isCorrect),
                ]);

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

    // Delete a specific exam with its questions
    public function destroy(Exam $exam)
    {
        $exam->delete();  // Delete the exam
        return redirect()->route('exams.index')->with('success', 'Exam deleted successfully');
    }

    //EDIT EXAMS

    public function edit(Exam $exam)
    {
        // Fetch all subjects to show in the dropdown
        $subjects = Subject::all();

        // Return the view with the exam and subjects data
        return view('exams.edit', compact('exam', 'subjects'));
    }

    // ExamController.php

    public function update(Request $request, Exam $exam)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'name' => 'required|string',
            'start_time' => 'required|date',
            'duration' => 'required|integer',
            'passing_marks' => 'required|integer',
            'subject_id' => 'nullable|exists:subjects,id',
        ]);

        // Update the exam data
        $exam->update([
            'name' => $validated['name'],
            'start_time' => $validated['start_time'],
            'duration' => $validated['duration'],
            'passing_marks' => $validated['passing_marks'],
            'subject_id' => $validated['subject_id'], // Update subject_id if provided
        ]);

        // Redirect back to the exams index with success message
        return redirect()->route('exams.index')->with('success', 'Exam updated successfully');
    }

}
