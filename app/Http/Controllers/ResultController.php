<?php

namespace App\Http\Controllers;

use App\Models\ExamResult;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    // Display the result for the student
    public function show(ExamResult $examResult)
    {
        return view('results.show', compact('examResult'));  // Display the result page
    }
}
