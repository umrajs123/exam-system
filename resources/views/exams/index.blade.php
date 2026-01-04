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

                                <!-- Edit Action -->
                                <a href="{{ route('exams.edit', $exam->id) }}"
                                    class="ml-4 text-yellow-500 hover:underline">Edit</a>

                                <!-- Delete Action -->
                                <div x-data="{ open: false }">
                                    <!-- Delete Button -->
                                    <button @click="open = true"
                                        class="ml-4 text-red-500 hover:text-red-700">
                                        Delete
                                    </button>

                                    <!-- Confirmation Modal -->
                                    <div x-show="open" x-transition @click.away="open = false"
                                        class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-75">
                                        <div class="p-6 bg-white rounded-lg shadow-lg">
                                            <h2 class="text-lg">Are you sure you want to delete this record?</h2>
                                            <div class="mt-4">
                                                <button @click="open = false"
                                                    class="px-4 py-2 text-black bg-gray-300 rounded-md">Cancel</button>
                                                <button @click="open = false; document.getElementById('delete-form-{{ $exam->id }}').submit();"
                                                    class="px-4 py-2 text-white bg-red-500 rounded-md">Confirm</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Delete Form (hidden, will be submitted on confirmation) -->
                                <form id="delete-form-{{ $exam->id }}" action="{{ route('exams.destroy', $exam->id) }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>

                            </td>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection