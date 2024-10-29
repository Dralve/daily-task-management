@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-center min-h-screen bg-gray-100 p-6">
        <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-3xl">
            <h1 class="text-3xl font-bold mb-4 text-center">{{ $task->title }}</h1>

            <div class="mb-4">
                <p class="text-gray-700 text-lg"><strong>Description:</strong></p>

                <!-- Description with word wrapping and no character limit -->
                <p class="text-gray-700 text-lg mb-4 break-words whitespace-pre-line">{{ $task->description }}</p>

                <p class="text-gray-700 text-lg"><strong>Status:</strong>
                    <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $task->status === 'Pending' ? 'bg-yellow-200 text-yellow-800' : 'bg-green-200 text-green-800' }}">
                        {{ $task->status }}
                    </span>
                </p>
                <p class="text-gray-700 text-lg"><strong>Due Date:</strong> {{ $task->due_date }}</p>
            </div>

            <!-- Back Button -->
            <div class="flex justify-center">
                <a href="{{ route('tasks.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Back to All Tasks
                </a>
            </div>
        </div>
    </div>
@endsection
