@extends('layouts.app')

@section('content')
    <div class="container p-6 mx-auto">
        <!-- Page Title -->
        <h1 class="mb-8 text-3xl font-semibold text-center text-gray-800">Exams</h1>

        <!-- Display Total Number of Teachers -->

        <div class="flex py-3 space-x-4">
            <a href="{{ route('admin.teachers.create') }}"
                class="inline-flex items-center px-2 py-1 text-xs font-medium text-green-700 rounded-md bg-green-50 inset-ring inset-ring-green-600/20">
                Add New Teacher
            </a>

            <a href="{{ route('admin.teachers.index') }}"
                class="inline-flex items-center px-2 py-1 text-xs font-medium text-purple-700 rounded-md bg-purple-50 inset-ring inset-ring-purple-700/10">
                All Teachers
            </a>

            <a href="{{ route('exams.create') }}"
                class="inline-flex items-center px-2 py-1 text-xs font-medium text-pink-700 rounded-md bg-pink-50 inset-ring inset-ring-pink-700/10">
                Create New Exam
            </a>

            <a href="{{ route('subjects.index') }}"
                class="inline-flex items-center px-2 py-1 text-xs font-medium text-yellow-700 rounded-md bg-yellow-50 inset-ring inset-ring-pink-700/10">
                Subjects List
            </a>
        </div>


        <!-- Exam List -->
        <div class="overflow-x-auto bg-white rounded-lg shadow-lg">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-4 py-2 font-medium text-left text-gray-600">Exam Name</th>
                        <th class="px-4 py-2 font-medium text-left text-gray-600">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($exams as $exam)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-4 py-2 text-gray-700">{{ $exam->name }}</td>
                            <td class="px-4 py-2 text-left">
                                <a href="{{ route('exams.show', $exam->id) }}" class="text-blue-500 hover:underline">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection