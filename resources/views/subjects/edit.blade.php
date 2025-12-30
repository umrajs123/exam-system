@extends('layouts.app')

@section('content')
        <h1 class="mb-8 text-3xl font-semibold text-center text-gray-800">Edit Subject</h1>     
<!-- Full Screen Container with Centered Content -->
    <div class="flex items-center justify-center bg-gray-100">

        <div class="p-6 mx-auto bg-white rounded-lg shadow-md ">
            <!-- Form to Edit Subject -->
            <form action="{{ route('subjects.update', $subject->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Subject Name Field -->
                <div class="mb-6">
                    <label for="name" class="block text-sm font-medium text-gray-700">Subject Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $subject->name) }}"
                        class="block w-full px-4 py-3 mt-2 text-lg border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                        required>
                    
                    @error('name')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="flex justify-center">
                    <button type="submit"
                        class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Update Subject
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
