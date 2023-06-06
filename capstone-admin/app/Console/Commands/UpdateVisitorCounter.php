<?php

namespace App\Console\Commands;

use App\Models\VisitorCounter;
use Illuminate\Console\Command;

class UpdateVisitorCounter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'visitor-counter:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the visitor counter';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $counter = VisitorCounter::findOrCreate(1);
        $counter->counter = 0;
        $counter->save();

        $this->info('Visitor counter has been reset.');
        return Command::SUCCESS;
    }
}
