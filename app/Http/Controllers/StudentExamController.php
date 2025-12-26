<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\ExamAnswer;
use App\Models\ExamSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentExamController extends Controller
{
    // Start the exam for a student
    public function start(Exam $exam)
    {
        // Check if the exam has questions
        if ($exam->questions->isEmpty()) {
            return redirect()->route('exams.index')->with('error', 'This exam has no questions.');
        }
        // Create a new exam session for the student
        $examSession = ExamSession::create([
            'exam_id' => $exam->id,
            'student_id' => Auth::id(),
            'started_at' => now(),
        ]);

        // Show the student the exam
        return view('student_exam.start', compact('exam', 'examSession'));
    }

    // Save the student's answer for a question
    public function saveAnswer(Request $request, ExamSession $examSession)
    {
        // Save the answer for the question
        ExamAnswer::create([
            'exam_session_id' => $examSession->id,
            'question_id' => $request->question_id,
            'question_option_id' => $request->question_option_id,
            'answer_text' => $request->answer_text,
        ]);

        // Redirect the student to the next question
        return redirect()->route('student_exam.start', $examSession->exam_id);
    }

    public function submit(ExamSession $examSession)
    {
        // Calculate the student's score
        $correctAnswers = ExamAnswer::where('exam_session_id', $examSession->id)
            ->whereHas('questionOption', function ($query) {
                $query->where('is_correct', true);
            })
            ->count();

        $examSession->ended_at = now();
        $examSession->save();

        $totalMarks = $correctAnswers; // Assuming 1 mark per question
        $examResult = $examSession->examResult()->create([
            'total_marks' => $totalMarks,
            'correct_answers' => $correctAnswers,
            'incorrect_answers' => $examSession->questions()->count() - $correctAnswers,
        ]);
        // Return the result to the student
        return view('student_exam.result', compact('examResult'));
    }
}
