<?php

namespace App\Jobs;

use App\Mail\TaskNotificationMail;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendTaskNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $tasks;

    /**
     * Create a new job instance.
     */
    public function __construct($user, $tasks)
    {
        $this->user = $user;
        $this->tasks = $tasks;
    }

    /**
     * Execute the job.
     * @throws Exception
     */
    public function handle(): void
    {
        Mail::to($this->user->email)->send(new TaskNotificationMail($this->tasks));
    }
}
