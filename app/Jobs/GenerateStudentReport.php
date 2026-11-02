<?php

namespace App\Jobs;

use App\Models\Student;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class GenerateStudentReport implements ShouldQueue
{
    use Queueable;

    public $tries = 3;

    public $backoff = [10, 30];

    public $timeout = 60;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $total = Student::count();

        Log::info('Student report generated', [
            'total_students' => $total,
        ]);
    }
}
