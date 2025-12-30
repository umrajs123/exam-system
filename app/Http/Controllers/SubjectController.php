<?php

namespace App\Http\Controllers;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->input('search');

        // If a search term is provided, filter the subjects
        if ($search) {
            $subjects = Subject::where('name', 'like', '%' . $search . '%')->get();
        } else {
            $subjects = Subject::all(); 
        }

        $subjectCount = $subjects->count();

        return view('subjects.index', compact('subjects', 'subjectCount'));
    }
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

    // Delete a subject
    public function destroy(Subject $subject)
    {
        $subject->delete();
        return redirect()->route('subjects.index')->with('success', 'Subject deleted successfully');
    }

    public function edit($id)
    {
        $subject = Subject::findOrFail($id);
        return view('subjects.edit', compact('subject'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $subject = Subject::findOrFail($id);
        $subject->name = $request->name;
        $subject->save();

        return redirect()->route('subjects.index')->with('success', 'Subject updated successfully.');
    }
}
