<?php

namespace App\Listeners;

use App\Events\StudentCreated;
use App\Models\User;
use App\Notifications\StudentCreatedNotification;
use Illuminate\Support\Facades\Log;

class LogStudentCreated
{
    public function handle(StudentCreated $event): void
    {
        // Log::info('StudentCreated event received', [
        //     'student_id' => $event->studentId,
        // ]);

         $user = User::find($event->userId);

        if (! $user) {
            return;
        }

        $user->notify(
            new StudentCreatedNotification($event->studentId)
        );
    }
}
