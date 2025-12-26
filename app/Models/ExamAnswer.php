<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamAnswer extends Model
{
    use HasFactory;

    protected $fillable = ['exam_session_id', 'question_id', 'question_option_id', 'answer_text'];  // Mass assignable fields

    // Relationship: An exam answer belongs to an exam session
    public function examSession()
    {
        return $this->belongsTo(ExamSession::class);
    }

    // Relationship: An exam answer belongs to a question
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    // Relationship: An exam answer belongs to a question option
    public function questionOption()
    {
        return $this->belongsTo(QuestionOption::class);
    }

}
