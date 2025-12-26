<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamSession extends Model
{
     use HasFactory;

    protected $fillable = ['exam_id', 'student_id', 'started_at', 'ended_at'];  // Mass assignable fields

    // Relationship: An exam session belongs to an exam
    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    // Relationship: An exam session belongs to a student (user)
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    // Relationship: An exam session has many answers
    public function examAnswers()
    {
        return $this->hasMany(ExamAnswer::class);
    }

    // Relationship: An exam session has one result
    public function examResult()
    {
        return $this->hasOne(ExamResult::class);
    }
}
