@extends('layouts.app')

@section('content')
    <div class="container p-6 mx-auto">
        <!-- Exam Title -->
        <h1 class="mb-6 text-3xl font-semibold text-center text-gray-800">{{ $exam->name }}</h1>

        <!-- Exam Details -->
        <div class="p-6 bg-white rounded-lg shadow-md">
            <div class="mb-4">
                <p class="text-lg text-gray-700"><strong>Start Time:</strong> {{ $exam->start_time }}</p>
                <p class="text-lg text-gray-700"><strong>Duration:</strong> {{ $exam->duration }} minutes</p>
                <p class="text-lg text-gray-700"><strong>Passing Marks:</strong> {{ $exam->passing_marks }}</p>
            </div>

            <!-- Questions List -->
            <h3 class="mb-4 text-2xl font-semibold text-gray-800">Questions</h3>
            <ul class="space-y-4">
                @foreach($exam->questions as $question)
                    <li class="py-4 border-b border-gray-200">
                        <p class="text-lg font-medium text-gray-800">{{ $question->question_text }}</p>
                        <ul class="pl-6 list-disc">
                            @foreach($question->options as $option)
                                <li class="text-gray-600">{{ $option->option_text }}</li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
