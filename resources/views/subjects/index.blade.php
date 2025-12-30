@extends('layouts.app')

@section('content')
    <div class="container p-6 mx-auto">
        <!-- Page Title -->
        <h1 class="mb-8 text-3xl font-semibold text-center text-gray-800">Subjects List</h1>

        <!-- Display Total Number of Subjects -->
        <div class="flex items-center justify-between mb-4">
            <span class="text-lg font-medium text-gray-600">Total Subjects: {{ $subjectCount }}</span>

            <!-- Add New Subject Button -->
            <a href="{{ route('exams.create') }}"
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-green-700 rounded-md bg-green-50 hover:bg-green-100">
                Add a New Subject
            </a>
        </div>

        <!-- Subjects Table -->
        <div class="overflow-x-auto bg-white rounded-lg shadow-lg">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-4 py-2 font-medium text-left text-gray-600">S. No</th>
                        <th class="px-4 py-2 font-medium text-left text-gray-600">Subject Name</th>
                        <th class="px-4 py-2 font-medium text-left text-gray-600">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($subjects as $index => $subject)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-4 py-2 text-gray-700 border border-gray-300 ">{{ $index + 1 }}</td>
                            <td class="px-4 py-2 text-gray-700 border border-gray-300">{{ $subject->name }}</td>
                            <td class="px-4 py-2 text-left border border-gray-300">
                                <!-- Edit Button -->
                                <a href="{{ route('subjects.edit', $subject->id) }}" class="text-blue-500 hover:underline">Edit</a>
                                
                                <!-- Delete Button -->
                                <form action="{{ route('subjects.destroy', $subject->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="ml-4 text-red-500 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-4 py-2 text-center text-gray-500">No Subject Found.</td>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
