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
     * The console command confirmation message.
     *
     * @var string
     */
    protected $confirmation_message = 'Do you really want to disable all accounts? This process can\'t be undone';

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
        if (!$this->confirm($this->confirmation_message)) return;

        $s = Student::where('enabled', true)
            ->get()->each(function ($student) {
                $student->update(['enabled' => false]);
            });

        printf(" => %d student account(s) were disabled!\n", $s->count());
    }
}
