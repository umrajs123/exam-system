<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    // Show all teachers
     public function index(Request $request)
    {
        $search = $request->input('search');

        // If a search term is provided, filter the teachers
        if ($search) {
            $teachers = User::where('role', 'teacher')
                            ->where('name', 'like', '%' . $search . '%')
                            ->get();
        } else {
            $teachers = User::where('role', 'teacher')->get();
        }

        $teacherCount = $teachers->count();

        return view('admin.teachers.index', compact('teachers', 'teacherCount'));
    }

    // Show the form to create a new teacher
    public function create()
    {
        return view('admin.teachers.create');
    }

    // Store a new teacher
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:teachers,email',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'teacher',
        ]);

        return redirect()->route('exams.index')->with('success', 'Teacher added successfully');
    }

    // Show the form to edit a teacher
    public function edit(User $teacher)
    {
        return view('admin.teachers.edit', compact('teacher'));
    }

    // Update a teacher's details
    public function update(Request $request, User $teacher)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:teachers,email,' . $teacher->id,
            'password' => 'nullable|string|min:8',
        ]);

        $teacher->name = $request->name;
        $teacher->email = $request->email;
        if ($request->password) {
            $teacher->password = Hash::make($request->password);
        }

        $teacher->save();

        return redirect()->route('admin.teachers.index')->with('success', 'Teacher updated successfully');
    }

    // Delete a teacher
    public function destroy(User $teacher)
    {
        $teacher->delete();
        return redirect()->route('admin.teachers.index')->with('success', 'Teacher deleted successfully');
    }

}
