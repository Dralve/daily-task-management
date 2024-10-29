@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6 space-y-6">
        <!-- Page Header -->
        <div class="flex justify-between items-center">
            <h1 class="text-3xl font-bold text-gray-800">Tasks</h1>
            <a href="{{ route('tasks.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-full shadow-lg transform transition duration-300 hover:scale-105">
                + Add Task
            </a>
        </div>

        <!-- Flash Messages -->
        @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-400 p-4 text-green-800 rounded shadow-md">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="bg-red-50 border-l-4 border-red-400 p-4 text-red-800 rounded shadow-md">
                {{ session('error') }}
            </div>
        @endif

        <!-- Action Buttons -->
        <div class="flex space-x-4">
            <a href="{{ route('tasks.pendingToday') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded shadow">
                View Pending Tasks
            </a>
        </div>

        <!-- Task Table -->
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <table class="min-w-full bg-white border border-gray-200 text-left">
                <thead>
                <tr class="bg-gray-100 text-gray-600 uppercase text-sm">
                    <th class="py-4 px-6">Title</th>
                    <th class="py-4 px-6">Description</th>
                    <th class="py-4 px-6">Due Date</th>
                    <th class="py-4 px-6">Status</th>
                    <th class="py-4 px-6">Actions</th>
                </tr>
                </thead>
                <tbody class="text-gray-700 text-sm divide-y">
                @foreach($tasks as $task)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="py-4 px-6 font-medium">{{ $task->title }}</td>
                        <td class="py-4 px-6">{{ Str::limit($task->description, 20, '...') }}</td> <!-- Directly using Str::limit -->
                        <td class="py-4 px-6">{{ $task->due_date }}</td>
                        <td class="py-4 px-6">
                            <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $task->status === 'Pending' ? 'bg-yellow-200 text-yellow-800' : 'bg-green-200 text-green-800' }}">
                                {{ $task->status }}
                            </span>
                        </td>
                        <td class="px-6 py-3 border-b flex space-x-2">
                            <!-- View Button -->
                            <a href="{{ route('tasks.show', $task) }}"
                               class="px-3 py-1 text-xs font-semibold rounded-full bg-green-200 text-green-800 hover:bg-green-300 transition-colors duration-300">
                                View
                            </a>

                            <!-- Edit Button -->
                            <a href="{{ route('tasks.edit', $task) }}"
                               class="px-3 py-1 text-xs font-semibold rounded-full bg-blue-200 text-blue-800 hover:bg-blue-300 transition-colors duration-300">
                                Edit
                            </a>

                            <!-- Delete Button -->
                            <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this task?');" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="px-3 py-1 text-xs font-semibold rounded-full bg-red-200 text-red-800 hover:bg-red-300 transition-colors duration-300">
                                    Delete
                                </button>
                            </form>

                            <!-- Toggle Status Button -->
                            <form action="{{ route('tasks.toggleStatus', $task) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit"
                                        class="px-3 py-1 text-xs font-semibold rounded-full bg-indigo-200 text-indigo-800 hover:bg-indigo-300 transition-colors duration-300">
                                    {{ $task->status === 'Pending' ? 'Mark as Completed' : 'Mark as Pending' }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination Links -->
        <div class="mt-6">
            {{ $tasks->links('pagination::tailwind') }}
        </div>
    </div>
@endsection
