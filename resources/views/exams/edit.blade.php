@extends('layouts.app')

@section('content')
    <div class="container p-6 mx-auto">
        <!-- Page Title -->
        <h1 class="mb-8 text-3xl font-semibold text-center text-gray-800">Edit Exam: {{ $exam->name }}</h1>

        <!-- Edit Exam Form -->
        <div class="p-6 bg-white rounded-lg shadow-md">
            <form action="{{ route('exams.update', $exam->id) }}" method="POST">
                @csrf
                @method('PUT')  <!-- This tells Laravel we're doing a PUT request for an update -->

                <!-- Exam Name -->
                <div class="mb-4">
                    <label for="name" class="block text-lg font-medium text-gray-700">Exam Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $exam->name) }}"
                        class="block w-full mt-2 border-gray-300 rounded-lg shadow-sm focus:ring-lime-500 focus:border-lime-500" required>
                </div>

                <!-- Start Time -->
                <div class="mb-4">
                    <label for="start_time" class="block text-lg font-medium text-gray-700">Start Time</label>
                    <input type="datetime-local" name="start_time" id="start_time" value="{{ old('start_time', $exam->start_time) }}"
                        class="block w-full mt-2 border-gray-300 rounded-lg shadow-sm focus:ring-lime-500 focus:border-lime-500" required>
                </div>

                <!-- Duration -->
                <div class="mb-4">
                    <label for="duration" class="block text-lg font-medium text-gray-700">Duration (minutes)</label>
                    <input type="number" name="duration" id="duration" value="{{ old('duration', $exam->duration) }}"
                        class="block w-full mt-2 border-gray-300 rounded-lg shadow-sm focus:ring-lime-500 focus:border-lime-500" required>
                </div>

                <!-- Passing Marks -->
                <div class="mb-4">
                    <label for="passing_marks" class="block text-lg font-medium text-gray-700">Passing Marks</label>
                    <input type="number" name="passing_marks" id="passing_marks" value="{{ old('passing_marks', $exam->passing_marks) }}"
                        class="block w-full mt-2 border-gray-300 rounded-lg shadow-sm focus:ring-lime-500 focus:border-lime-500" required>
                </div>

                <!-- Subject Selection -->
                <div class="mb-4">
                    <label for="subject_id" class="block text-lg font-medium text-gray-700">Select Subject</label>
                    <select name="subject_id" id="subject_id"
                        class="block w-full mt-2 border-gray-300 rounded-lg shadow-sm focus:ring-lime-500 focus:border-lime-500">
                        <option value="">Select a Subject</option>
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}" {{ old('subject_id', $exam->subject_id) == $subject->id ? 'selected' : '' }}>
                                {{ $subject->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Update Button -->
                <div class="flex justify-end">
                    <button type="submit"
                        class="px-4 py-2 text-white transition duration-200 ease-in-out bg-blue-500 rounded-lg shadow-md hover:bg-blue-600 focus:ring-4 focus:ring-blue-300">
                        Update Exam
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
