<?php

namespace App\Console\Commands;

use App\Models\Student;
use Illuminate\Console\Command;

class DisableStudentAccounts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'students:disable';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Disable all the previous student accounts.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Student::where('enabled', true)
            ->get()->each(function ($student) {
                $student->update(['enabled' => false]);
            });
    }
}
