@extends('layouts.app')

@section('content')
    <div class="container p-6 mx-auto">
        <!-- Page Title -->
        <h1 class="mb-6 text-3xl font-semibold text-center text-gray-800">Create New Exam</h1>

        <!-- Add Subject Form -->
        <div class="p-6 mb-6 bg-white rounded-lg shadow-md">
            <h2 class="mb-4 text-2xl font-semibold text-gray-700">Add New Subject</h2>
            <form action="{{ route('subjects.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="subject_name" class="block text-lg font-medium text-gray-700">Subject Name</label>
                    <input type="text" name="name" id="subject_name"
                        class="block w-full mt-2 border-gray-300 rounded-lg shadow-sm focus:ring-lime-500 focus:border-lime-500"
                        required>
                </div>
                <button type="submit"
                    class="px-4 py-2 text-white transition duration-200 ease-in-out bg-blue-500 rounded-lg shadow-md hover:bg-blue-600 focus:ring-4 focus:ring-blue-300">
                    Add Subject
                </button>
            </form>
        </div>
        <!-- Create Exam Form -->
        <div class="p-6 bg-white rounded-lg shadow-md">
            <form action="{{ route('exams.store') }}" method="POST">
                @csrf

                @if($errors->any())
                    <div class="p-4 mb-4 text-red-700 border border-red-200 rounded bg-red-50">
                        <ul class="pl-5 list-disc">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Exam Name -->
                <div class="mb-4">
                    <label for="name" class="block text-lg font-medium text-gray-700"><strong>Exam Name</strong></label>
                    <input type="text" name="name" id="name"
                        class="block w-full mt-2 border-gray-300 rounded-lg shadow-sm focus:ring-lime-500 focus:border-lime-500"
                        required>
                </div>

                <!-- Start Time -->
                <div class="mb-4">
                    <label for="start_time" class="block text-lg font-medium text-gray-700">Start Time</label>
                    <input type="datetime-local" name="start_time" id="start_time"
                        class="block w-full mt-2 border-gray-300 rounded-lg shadow-sm focus:ring-lime-500 focus:border-lime-500"
                        required>
                </div>

                <!-- Duration -->
                <div class="mb-4">
                    <label for="duration" class="block text-lg font-medium text-gray-700">Duration (minutes)</label>
                    <input type="number" name="duration" id="duration"
                        class="block w-full mt-2 border-gray-300 rounded-lg shadow-sm focus:ring-lime-500 focus:border-lime-500"
                        required>
                </div>

                <!-- Passing Marks -->
                <div class="mb-4">
                    <label for="passing_marks" class="block text-lg font-medium text-gray-700">Passing Marks</label>
                    <input type="number" name="passing_marks" id="passing_marks"
                        class="block w-full mt-2 border-gray-300 rounded-lg shadow-sm focus:ring-lime-500 focus:border-lime-500"
                        required>
                </div>

                <!-- Subject Selection -------------------------------------------------->
                <div class="mb-4">
                    <label for="subject_id" class="block text-lg font-medium text-gray-700">Select Subject</label>
                    <select name="subject_id" id="subject_id"
                        class="block w-full mt-2 border-gray-300 rounded-lg shadow-sm focus:ring-lime-500 focus:border-lime-500">
                        <option value="">Select a Subject</option>
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                        @endforeach
                        <option value="add_new" id="addNewOption">Add a New Subject</option>
                    </select>
                </div>

                <!-- Add New Subject (Textbox) -------------------------------------------->
                <div id="newSubjectField" class="hidden mb-4">
                    <label for="new_subject_name" class="block text-lg font-medium text-gray-700">New Subject Name</label>
                    <input type="text" name="new_subject_name" id="new_subject_name"
                        class="block w-full mt-2 border-gray-300 rounded-lg shadow-sm focus:ring-lime-500 focus:border-lime-500">
                </div>

                <!-- Add Questions Section -->
                <div id="questionFields" class="mb-6 space-y-6">
                    <!-- Each Question will be added here dynamically -->
                </div>

                <!-- Add Question Button -->
                <button type="button" id="addQuestionBtn"
                    class="px-4 py-2 text-white transition duration-200 ease-in-out bg-blue-500 rounded-lg shadow-md hover:bg-blue-600 focus:ring-4 focus:ring-blue-300">
                    Add Question
                </button>

                <button type="submit"
                    class="w-full px-4 py-2 mt-6 font-semibold text-white transition duration-200 ease-in-out bg-green-500 rounded-lg shadow-md sm:w-auto hover:bg-green-600 focus:ring-4 focus:ring-green-300">
                    Create Exam
                </button>
            </form>
        </div>
    </div>

    <!-- Script to dynamically add questions and options -->
    <script>
        let questionCount = 0;

        document.getElementById('addQuestionBtn').addEventListener('click', () => {
            questionCount++;

            const questionDiv = document.createElement('div');
            questionDiv.classList.add('bg-white', 'p-4', 'border', 'border-gray-300', 'rounded-lg');
            questionDiv.innerHTML = `
                                    <h3 class="mb-2 text-lg font-semibold">Question ${questionCount}</h3>

                                    <div class="mb-4">
                                        <label for="question_text_${questionCount}" class="block text-lg font-medium text-gray-700">Question Text</label>
                                        <input type="text" name="questions[${questionCount}][question_text]" id="question_text_${questionCount}" class="block w-full mt-2 border-gray-300 rounded-lg shadow-sm focus:ring-lime-500 focus:border-lime-500" required>
                                    </div>


                                    <!-- Difficulty Level -->
                                <div class="mb-4">
                                    <label for="difficulty_level_${questionCount}" class="block text-lg font-medium text-gray-700">Difficulty Level</label>
                                    <input type="number" name="questions[${questionCount}][difficulty_level]" id="difficulty_level_${questionCount}" class="block w-full mt-2 border-gray-300 rounded-lg shadow-sm focus:ring-lime-500 focus:border-lime-500" min="1" max="5" required>
                                </div>

                                    <!-- Options for this Question -->
                                    <div class="space-y-4" id="options_${questionCount}">
                                        <div class="flex items-center space-x-3">
                                            <input type="radio" name="questions[${questionCount}][correct_option]" value="0" class="border-gray-300 rounded-md form-radio text-lime-500 focus:ring-lime-500">
                                            <input type="text" name="questions[${questionCount}][options][]" placeholder="Option 1" class="block w-full mt-2 border-gray-300 rounded-lg shadow-sm focus:ring-lime-500 focus:border-lime-500">
                                        </div>
                                        <div class="flex items-center space-x-3">
                                            <input type="radio" name="questions[${questionCount}][correct_option]" value="1" class="border-gray-300 rounded-md form-radio text-lime-500 focus:ring-lime-500">
                                            <input type="text" name="questions[${questionCount}][options][]" placeholder="Option 2" class="block w-full mt-2 border-gray-300 rounded-lg shadow-sm focus:ring-lime-500 focus:border-lime-500">
                                        </div>
                                    </div>

                                    <button type="button" class="mt-2 text-blue-500 hover:underline" onclick="addOption(${questionCount})">Add More Options</button>
                                `;

            document.getElementById('questionFields').appendChild(questionDiv);
        });

        function addOption(questionId) {
            const optionsDiv = document.getElementById(`options_${questionId}`);
            const optionDiv = document.createElement('div');
            optionDiv.classList.add('flex', 'items-center', 'space-x-3');
            optionDiv.innerHTML = `
                                    <input type="radio" name="questions[${questionId}][correct_option]" value="${optionsDiv.children.length}" class="border-gray-300 rounded-md form-radio text-lime-500 focus:ring-lime-500">
                                    <input type="text" name="questions[${questionId}][options][]" placeholder="Option ${optionsDiv.children.length + 1}" class="block w-full mt-2 border-gray-300 rounded-lg shadow-sm focus:ring-lime-500 focus:border-lime-500">
                                `;
            optionsDiv.appendChild(optionDiv);
        }
    </script>

    <!-- Script to handle dynamic subject addition -->
    <script>

        const subjectDropdown = document.getElementById('subject_id');
        const newSubjectField = document.getElementById('newSubjectField');
        const addNewOption = document.getElementById('addNewOption');

        subjectDropdown.addEventListener('change', function () {
            if (subjectDropdown.value === 'add_new') {
                newSubjectField.classList.remove('hidden');
            } else {
                newSubjectField.classList.add('hidden');
            }
        });
    </script>
@endsection