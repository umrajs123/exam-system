@extends('layouts.app')

@section('content')
    <div class="container p-6 mx-auto">
        <!-- Exam Title -->
        <h1 class="mb-8 text-3xl font-semibold text-center text-gray-800">{{ $exam->name }}</h1>

        <!-- Exam Questions -->
        <form action="{{ route('student_exam.save_answer', $examSession) }}" method="POST" class="space-y-6">
            @csrf

            @foreach($exam->questions as $question)
                <div class="p-6 bg-white rounded-lg shadow-md">
                    <p class="mb-4 text-lg font-medium text-gray-800">{{ $question->question_text }}</p>

                    <div class="space-y-4">
                        @foreach($question->options as $option)
                            <div class="flex items-center space-x-3">
                                <input type="radio" name="question_option_id[{{ $question->id }}]" value="{{ $option->id }}" class="border-gray-300 rounded-md form-radio text-lime-500 focus:ring-lime-500" id="option{{ $option->id }}">
                                <label class="text-gray-700" for="option{{ $option->id }}">
                                    {{ $option->option_text }}
                                </label>
                            </div>
                        @endforeach
                    </div>

                    <textarea name="answer_text[{{ $question->id }}]" class="block w-full mt-4 border-gray-300 rounded-lg shadow-sm focus:ring-lime-500 focus:border-lime-500" placeholder="Type your answer here" rows="3"></textarea>
                </div>
            @endforeach

            <!-- Save Answer Button -->
            <div class="flex justify-between mt-8">
                <button type="submit" class="w-full py-3 font-semibold text-white transition duration-200 ease-in-out rounded-lg shadow-md sm:w-auto bg-lime-500 hover:bg-lime-600 focus:ring-4 focus:ring-lime-300">
                    Save Answer
                </button>

                <!-- Submit Exam Button -->
                <form action="{{ route('student_exam.submit', $examSession) }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full py-3 font-semibold text-white transition duration-200 ease-in-out bg-green-500 rounded-lg shadow-md sm:w-auto hover:bg-green-600 focus:ring-4 focus:ring-green-300">
                        Submit Exam
                    </button>
                </form>
            </div>
        </form>
    </div>
@endsection
