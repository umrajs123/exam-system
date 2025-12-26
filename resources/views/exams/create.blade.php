@extends('layouts.app')

@section('content')
    <div class="container p-6 mx-auto">
        <!-- Page Title -->
        <h1 class="mb-6 text-3xl font-semibold text-center text-gray-800">Create New Exam</h1>

        <!-- Create Exam Form -->
        <div class="p-6 bg-white rounded-lg shadow-md">
            <form action="{{ route('exams.store') }}" method="POST">
                @csrf
                <!-- Exam Name -->
                <div class="mb-4">
                    <label for="name" class="block text-lg font-medium text-gray-700">Exam Name</label>
                    <input type="text" name="name" id="name" class="block w-full mt-2 border-gray-300 rounded-lg shadow-sm focus:ring-lime-500 focus:border-lime-500" required>
                </div>

                <!-- Start Time -->
                <div class="mb-4">
                    <label for="start_time" class="block text-lg font-medium text-gray-700">Start Time</label>
                    <input type="datetime-local" name="start_time" id="start_time" class="block w-full mt-2 border-gray-300 rounded-lg shadow-sm focus:ring-lime-500 focus:border-lime-500" required>
                </div>

                <!-- Duration -->
                <div class="mb-4">
                    <label for="duration" class="block text-lg font-medium text-gray-700">Duration (minutes)</label>
                    <input type="number" name="duration" id="duration" class="block w-full mt-2 border-gray-300 rounded-lg shadow-sm focus:ring-lime-500 focus:border-lime-500" required>
                </div>

                <!-- Passing Marks -->
                <div class="mb-4">
                    <label for="passing_marks" class="block text-lg font-medium text-gray-700">Passing Marks</label>
                    <input type="number" name="passing_marks" id="passing_marks" class="block w-full mt-2 border-gray-300 rounded-lg shadow-sm focus:ring-lime-500 focus:border-lime-500" required>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full py-3 font-semibold text-white transition duration-200 ease-in-out rounded-lg shadow-md bg-lime-500 hover:bg-lime-600 focus:ring-4 focus:ring-lime-300">
                    Create Exam
                </button>
            </form>
        </div>
    </div>
@endsection
