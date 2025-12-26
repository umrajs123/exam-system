<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionOption extends Model
{
    use HasFactory;

    protected $fillable = ['question_id', 'option_text', 'is_correct'];  // Mass assignable fields

    // Relationship: A question option belongs to a question
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
