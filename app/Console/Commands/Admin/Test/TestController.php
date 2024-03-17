<?php

namespace App\Console\Commands\Admin\Test;

use App\Http\Controllers\Admin\Test\TestController as TestTestController;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class TestController extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command test';

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
        TestTestController::test();
    }
}
