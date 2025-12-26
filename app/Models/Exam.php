<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'start_time', 'duration', 'passing_marks'];  // Mass assignable fields

    // Relationship: An exam has many questions
    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    // Relationship: An exam has many exam sessions
    public function examSessions()
    {
        return $this->hasMany(ExamSession::class);
    }
}
