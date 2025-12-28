<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['exam_id', 'subject_id', 'question_text', 'difficulty_level'];  // Mass assignable fields

    // Relationship: A question belongs to a subject
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    // Relationship: A question has many options
    public function options()
    {
        return $this->hasMany(QuestionOption::class);
    }
}
