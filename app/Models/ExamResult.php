<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamResult extends Model
{
    use HasFactory;

    protected $fillable = ['exam_session_id', 'total_marks', 'correct_answers', 'incorrect_answers'];  // Mass assignable fields

    // Relationship: An exam result belongs to an exam session
    public function examSession()
    {
        return $this->belongsTo(ExamSession::class);
    }
}
