<?php

namespace App\Console\Commands\Admin\Promotion;

use App\Models\Promotion;
use Illuminate\Console\Command;

class InactivePromotion extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'promotion:inactive';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Disable all promotion when the end date is less that today';

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
        Promotion::where('active', true)
        ->whereDate('date_end', '<=', date('Y-m-d'))
        ->update([
            'active' => false
        ]);
    }
}
