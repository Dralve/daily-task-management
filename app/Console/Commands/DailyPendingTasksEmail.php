<?php

namespace App\Console\Commands;

use App\Jobs\SendTaskNotificationJob;
use App\Models\Task;
use App\Models\User;
use Illuminate\Console\Command;

class DailyPendingTasksEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tasks:send-daily-notifications';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send daily notifications of pending tasks';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $users = User::all();

        foreach ($users as $user) {
            $tasks = Task::where('status', 'Pending')->get()->toArray();

            if (!empty($tasks)) {
                SendTaskNotificationJob::dispatch($user, $tasks);
            }
        }
        return 0;
    }
}
