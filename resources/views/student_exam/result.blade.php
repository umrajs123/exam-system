@extends('layouts.app')

@section('content')
    <div class="container p-6 mx-auto">
        <!-- Page Title -->
        <h1 class="mb-8 text-3xl font-semibold text-center text-gray-800">Exam Results</h1>

        <!-- Result Card -->
        <div class="p-6 bg-white rounded-lg shadow-md">
            <!-- Total Marks -->
            <div class="mb-4">
                <p class="text-lg text-gray-700"><strong>Total Marks:</strong> {{ $examResult->total_marks }}</p>
            </div>

            <!-- Correct Answers -->
            <div class="mb-4">
                <p class="text-lg text-green-600"><strong>Correct Answers:</strong> {{ $examResult->correct_answers }}</p>
            </div>

            <!-- Incorrect Answers -->
            <div class="mb-4">
                <p class="text-lg text-red-600"><strong>Incorrect Answers:</strong> {{ $examResult->incorrect_answers }}</p>
            </div>

            <!-- Optional: Percentage -->
            <div class="mt-6 text-center">
                <p class="text-xl font-medium text-gray-700">
                    <strong>Percentage:</strong>
                    {{ round(($examResult->correct_answers / $examResult->total_marks) * 100, 2) }}%
                </p>
            </div>
        </div>
    </div>
@endsection
