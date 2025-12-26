@extends('layouts.app')

@section('content')
    <h1>Welcome, {{ Auth::user()->name }}</h1>

    @if(Auth::user()->role == 'admin')
        <p>You are an admin.</p>
        <a href="{{ route('exams.index') }}" class="btn btn-primary">Go to Exam Management</a>
    @else
        <p class="text-blue-600">You are a student.</p>
        <a href="{{ route('student_exam.start', 1) }}" class="btn btn-primary">Start Your Exam</a>
    @endif
@endsection
