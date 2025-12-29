@extends('layouts.app')

@section('content')
    <div class="container p-6 mx-auto">
        <!-- Page Title -->
        <h1 class="mb-8 text-3xl font-semibold text-center text-gray-800">Teachers List</h1>

        <!-- Display Total Number of Teachers -->
        <div class="flex items-center justify-between mb-4">
            <span class="text-lg font-medium text-gray-600">Total Teachers: {{ $teacherCount }}</span>

            <!-- Add New Teacher Button -->
            <a href="{{ route('admin.teachers.create') }}" class="inline-flex items-center px-2 py-1 text-xs font-medium text-green-700 rounded-md bg-green-50 inset-ring inset-ring-green-600/20">
                Add New Teacher
            </a>
        </div>

        <!-- Teachers Table -->
        <div class="overflow-x-auto bg-white rounded-lg shadow-lg">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-4 py-2 font-medium text-left text-gray-600">Name</th>
                        <th class="px-4 py-2 font-medium text-left text-gray-600">Email</th>
                        <th class="px-4 py-2 font-medium text-left text-gray-600">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($teachers as $teacher)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-4 py-2 text-gray-700">{{ $teacher->name }}</td>
                            <td class="px-4 py-2 text-gray-700">{{ $teacher->email }}</td>
                            <td class="px-4 py-2 text-left">
                                <!-- Edit Button -->
                                <a href="{{ route('admin.teachers.edit', $teacher->id) }}" class="text-blue-500 hover:underline">Edit</a>

                                <!-- Delete Button -->
                                <form action="{{ route('admin.teachers.destroy', $teacher->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="ml-4 text-red-500 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
