<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        // Search in the subjects table if a search query is provided
        if ($search) {
            $subjects = Subject::where('name', 'like', '%' . $search . '%')->get();
        } else {
            $subjects = Subject::all();
        }

        $subjectCount = $subjects->count(); // Get the total count of subjects

        return view('subjects.index', compact('subjects', 'subjectCount'));
    }
}