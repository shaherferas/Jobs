<?php
namespace App\Notifications;

use App\Models\Job;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class JobCreated extends Notification implements ShouldQueue
{
    use Queueable;

    protected $job;

    public function __construct(Job $job)
    {
        $this->job = $job;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        Log::info('A new job has been created: ' . $this->job->id);
        return (new MailMessage)
            ->line('A new job has been created.')
            ->action('View Job', url('/jobs/' . $this->job->id))
            ->line('Thank you for using our application!');
    }
}
