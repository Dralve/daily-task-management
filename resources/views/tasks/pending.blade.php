@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-semibold mb-4">Today's Pending Tasks</h1>

        <!-- Back Button with Enhanced Style -->
        <div class="mb-4">
            <a href="{{ route('tasks.index') }}"
               class="px-4 py-2 bg-gray-200 text-gray-800 font-semibold rounded-full transition-all duration-300
                      hover:bg-gray-300 hover:text-gray-900 shadow-md">
                Back to All Tasks
            </a>
        </div>

        <!-- Pending Tasks List -->
        @if($tasks->isEmpty())
            <p class="text-gray-600">No pending tasks for today.</p>
        @else
            <ul class="space-y-4">
                @foreach($tasks as $task)
                    <li class="p-4 rounded-lg bg-yellow-50 border border-yellow-200 transition-all duration-300
                               hover:bg-yellow-100 hover:shadow-lg">
                        <h3 class="text-lg font-semibold text-yellow-800">{{ $task->title }}</h3>
                        <p class="text-gray-700">{{ Str::limit($task->description, 50, '...') }}</p>
                        <p class="text-gray-600 text-sm">Due: {{ $task->due_date }}</p>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection
