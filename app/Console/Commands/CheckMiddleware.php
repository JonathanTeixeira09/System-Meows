<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Http\Kernel;

class CheckMiddleware extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
//    protected $signature = 'app:check-middleware';

    /**
     * The console command description.
     *
     * @var string
     */
//    protected $description = 'Command description';
    protected $signature = 'check:middleware';
    protected $description = 'List registered middleware';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $kernel = app(Kernel::class);

        $this->info('Global Middleware:');
        foreach ($kernel->getGlobalMiddleware() as $middleware) {
            $this->line("- $middleware");
        }

        $this->info("\nMiddleware Groups:");
        foreach ($kernel->getMiddlewareGroups() as $group => $middlewares) {
            $this->info("[$group]");
            foreach ($middlewares as $middleware) {
                $this->line("- $middleware");
            }
        }
    }
}
