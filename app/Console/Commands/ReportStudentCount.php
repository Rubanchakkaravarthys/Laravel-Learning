<?php

namespace App\Console\Commands;

use App\Models\Student;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ReportStudentCount extends Command
{
    protected $signature = 'students:report-count';

    protected $description = 'Report the total number of students';

    public function handle(): int
    {
        $total = Student::count();

        Log::info('Student count report', [
            'total_students' => $total,
        ]);

        $this->info("Total students: {$total}");

        return self::SUCCESS;
    }
}
