<?php

namespace App\Services\Task;

use App\Models\Task;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class TaskService
{

    /**
     * @return LengthAwarePaginator
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function listTasks(): LengthAwarePaginator
    {
        try {
            $tasks = Cache::remember('tasks.all', 60, function () {
                return Task::all();
            });

            $currentPage = request()->get('page', 1);
            $perPage = 10;

            return new LengthAwarePaginator(
                $tasks->forPage($currentPage, $perPage),
                $tasks->count(),
                $perPage,
                $currentPage,
                ['path' => request()->url(), 'query' => request()->query()]
            );
        } catch (Exception $e) {
            Log::error('Error listing tasks: ' . $e->getMessage());

            return new LengthAwarePaginator(
                collect(),
                0,
                10,
                1,
                ['path' => request()->url(), 'query' => request()->query()]
            );
        }
    }

    /**
     * @param array $data
     * @return null
     */
    public function createTask(array $data)
    {
        try {
            $task = Task::create($data);
            Cache::forget('tasks.all');

            return $task;
        } catch (Exception $e) {
            Log::error("Failed to create task: " . $e->getMessage());
            return null;
        }
    }

    /**
     * @param int $taskId
     * @return null
     */
    public function getTaskById(int $taskId)
    {
        try {
            return Task::findOrFail($taskId);
        } catch (ModelNotFoundException $e) {
            Log::error("Task with ID {$taskId} not found: " . $e->getMessage());
            return null;
        } catch (Exception $e) {
            Log::error("Failed to retrieve task ID {$taskId}: " . $e->getMessage());
            return null;
        }
    }

    /**
     * @param Task $task
     * @param array $data
     * @return Task|null
     */
    public function updateTask(Task $task, array $data): ?Task
    {
        try {
            $task->update($data);

            Cache::forget('tasks.all');

            return $task;
        } catch (Exception $e) {
            Log::error("Failed to update task: " . $e->getMessage());
            return null;
        }
    }

    /**
     * @param Task $task
     * @return bool
     */
    public function deleteTask(Task $task): bool
    {
        try {
            $task->delete();
            Cache::forget('tasks.all');
        } catch (Exception $e) {
            Log::error("Failed to delete task ID {$task->id}: " . $e->getMessage());
            return false;
        }

        return true;
    }

    /**
     * @param Task $task
     * @return bool
     */
    public function toggleStatus(Task $task): bool
    {
        try {
            $task->status = $task->status === 'Pending' ? 'Completed' : 'Pending';
            $task->save();
            Cache::forget('tasks.all');
        } catch (Exception $e) {
            Log::error("Failed to toggle status for task ID {$task->id}: " . $e->getMessage());
            return false;
        }

        return true;
    }

    /**
     * @return Collection
     */
    public function getAllPendingTasks(): Collection
    {
        try {
            return Task::where('status', 'Pending')->get();
        } catch (Exception $e) {
            Log::error("Failed to retrieve pending tasks: " . $e->getMessage());
            return collect();
        }
    }
}
