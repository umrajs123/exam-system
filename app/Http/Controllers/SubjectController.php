<?php

namespace App\Http\Controllers;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:subjects,name',
        ]);

        // Create a new subject
        Subject::create([
            'name' => $validated['name'],
        ]);

        return redirect()->back()->with('success', 'Subject added successfully');
    }
}
