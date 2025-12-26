<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subject;
use App\Models\Exam;
use App\Models\Question;
use App\Models\QuestionOption;

class ExamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed Subject
        $subject = Subject::create([
            'name' => 'Mathematics',  // Name of the subject
        ]);
        
        // Seed Exam
        $exam = Exam::create([
            'name' => 'Mathematics Final Exam',
            'start_time' => now(),
            'duration' => 60,  // 1 hour
            'passing_marks' => 50,  // Passing marks threshold
        ]);

        // Seed Questions for the Exam
        $question1 = Question::create([
            'exam_id' => $exam->id,  // Ensure exam_id is correct
            'subject_id' => $subject->id,  // Ensure subject_id is correct
            'question_text' => 'What is 2 + 2?',
            'difficulty_level' => 1,  // Easy
        ]);

        $question2 = Question::create([
            'exam_id' => $exam->id,
            'subject_id' => $subject->id,  // Ensure subject_id is correct
            'question_text' => 'What is the capital of France?',
            'difficulty_level' => 1,  // Easy
        ]);

        // Seed Question Options for the First Question
        QuestionOption::create([
            'question_id' => $question1->id,
            'option_text' => '4',
            'is_correct' => true,
        ]);

        QuestionOption::create([
            'question_id' => $question1->id,
            'option_text' => '5',
            'is_correct' => false,
        ]);

        // Seed Question Options for the Second Question
        QuestionOption::create([
            'question_id' => $question2->id,
            'option_text' => 'Paris',
            'is_correct' => true,
        ]);

        QuestionOption::create([
            'question_id' => $question2->id,
            'option_text' => 'Berlin',
            'is_correct' => false,
        ]);
    }
}
