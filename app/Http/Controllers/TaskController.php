<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\StoreTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Services\Task\TaskService;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class TaskController extends Controller
{
    protected TaskService $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
        $this->middleware('auth');
    }

    /**
     * Display a list of tasks.
     *
     * @return Factory|View|Application
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function index(): Factory|View|Application
    {
        $tasks = $this->taskService->listTasks();
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form to create a new task.
     *
     * @return Factory|View|Application
     */
    public function create(): Factory|View|Application
    {
        return view('tasks.create');
    }

    /**
     * Display the specified task.
     *
     * @param Task $task
     * @return View|RedirectResponse
     */
    public function show(Task $task): View|RedirectResponse
    {
        return view('tasks.show', compact('task'));
    }

    /**
     * Store a newly created task in storage.
     *
     * @param StoreTaskRequest $request
     * @return RedirectResponse
     */
    public function store(StoreTaskRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $task = $this->taskService->createTask($data);
        if ($task) {
            return redirect()->route('tasks.index')->with('success', 'Task added successfully.');
        }

        return redirect()->route('tasks.index')->with('error', 'Failed to add task.');
    }

    /**
     * Show the form to edit an existing task.
     *
     * @param Task $task
     * @return Factory|View|Application
     */
    public function edit(Task $task): Factory|View|Application
    {
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified task in storage.
     *
     * @param UpdateTaskRequest $request
     * @param Task $task
     * @return RedirectResponse
     */
    public function update(UpdateTaskRequest $request, Task $task): RedirectResponse
    {
        $data = $request->validated();
        $updatedTask = $this->taskService->updateTask($task, $data);

        if ($updatedTask) {
            return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
        }

        return redirect()->route('tasks.index')->with('error', 'Failed to update task.');
    }

    /**
     * Remove the specified task from storage.
     *
     * @param Task $task
     * @return RedirectResponse
     */
    public function destroy(Task $task): RedirectResponse
    {
        $deleted = $this->taskService->deleteTask($task);

        if ($deleted) {
            return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
        }

        return redirect()->route('tasks.index')->with('error', 'Failed to delete task.');
    }

    /**
     * Toggle the status of the specified task.
     *
     * @param Task $task
     * @return RedirectResponse
     */
    public function toggleStatus(Task $task): RedirectResponse
    {
        $statusChanged = $this->taskService->toggleStatus($task);

        if ($statusChanged) {
            return redirect()->route('tasks.index')->with('success', 'Task status updated.');
        }

        return redirect()->route('tasks.index')->with('error', 'Failed to update task status.');
    }

    /**
     * Display a list of pending tasks for today.
     *
     * @return Factory|View|Application
     */
    public function getPendingTasks(): Factory|View|Application
    {
        $tasks = $this->taskService->getAllPendingTasks();
        return view('tasks.pending', compact('tasks'));
    }
}
