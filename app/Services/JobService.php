<?php
namespace App\Services;

use App\Models\Job;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\JobCreated;

class JobService
{
    public function createJob(array $data)
    {
        $job = Job::create([
            'user_id' => Auth::id(),
            'title' => $data['title'],
            'description' => $data['description'],
        ]);

        Notification::route('mail', 'manager@example.com')->notify(new JobCreated($job));

        return $job;
    }



    public function listJobs()
    {
        $user = Auth::user();

        if ($user->isManager()) {
            return Job::all();
        } else {
            return Job::where('user_id', $user->id)->get();
        }
    }
}
