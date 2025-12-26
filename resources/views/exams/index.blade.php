@extends('layouts.app')

@section('content')
    <div class="container p-6 mx-auto">
        <!-- Page Title -->
        <h1 class="mb-8 text-3xl font-semibold text-center text-gray-800">Exams</h1>

        <!-- Create New Exam Button -->
        <div class="flex items-center justify-between mb-4">
            <a href="{{ route('exams.create') }}" class="px-4 py-2 text-lg font-medium text-white transition duration-200 ease-in-out bg-blue-400 rounded-lg hover:bg-blue-500">
                Create New Exam
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
