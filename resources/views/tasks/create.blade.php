@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6 flex justify-center">
        <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-lg">
            <h1 class="text-2xl font-semibold mb-6 text-center text-gray-800">Add New Task</h1>

            <!-- Display validation errors -->
            @if ($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded mb-6 shadow">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('tasks.store') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label for="title" class="block font-medium text-gray-700 mb-1">Title</label>
                    <input type="text" name="title" id="title"
                           class="border border-gray-300 p-3 rounded w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400"
                           required>
                </div>

                <div>
                    <label for="description" class="block font-medium text-gray-700 mb-1">Description</label>
                    <textarea name="description" id="description"
                              class="border border-gray-300 p-3 rounded w-full h-32 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400"
                              required></textarea>
                </div>

                <div>
                    <label for="due_date" class="block font-medium text-gray-700 mb-1">Due Date</label>
                    <input type="date" name="due_date" id="due_date"
                           class="border border-gray-300 p-3 rounded w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400"
                           required>
                </div>

                <!-- Submit and Cancel Buttons -->
                <div class="flex justify-between items-center pt-4">
                    <button type="submit"
                            class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-6 rounded shadow-md transition-transform transform hover:scale-105">
                        Add Task
                    </button>
                    <a href="{{ route('tasks.index') }}"
                       class="text-gray-600 hover:text-gray-900 font-semibold transition-transform transform hover:scale-105">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
