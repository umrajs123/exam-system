@extends('layouts.app')

@section('content')
    <div class="container p-6 mx-auto">
        <h1 class="text-3xl font-semibold text-center text-gray-800">Edit Teacher</h1>

        <form action="{{ route('admin.teachers.update', $teacher->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="name" class="block text-lg font-medium text-gray-700">Teacher Name</label>
                <input type="text" name="name" id="name" value="{{ $teacher->name }}" class="block w-full mt-2 border-gray-300 rounded-lg shadow-sm" required>
            </div>

            <div class="mb-4">
                <label for="email" class="block text-lg font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="{{ $teacher->email }}" class="block w-full mt-2 border-gray-300 rounded-lg shadow-sm" required>
            </div>

            <div class="mb-4">
                <label for="password" class="block text-lg font-medium text-gray-700">Password (Leave empty to keep current password)</label>
                <input type="password" name="password" id="password" class="block w-full mt-2 border-gray-300 rounded-lg shadow-sm">
            </div>

            <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-600">Update Teacher</button>
        </form>
    </div>
@endsection
