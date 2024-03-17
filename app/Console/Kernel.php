<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        //Test
        // $schedule->command('test:test')->everyMinute()->withoutOverlapping();
        //System
        $schedule->command('queue:work --stop-when-empty')->everyMinute()->withoutOverlapping();
        //Sitemap
        $schedule->command('sitemap:generate')->daily()->withoutOverlapping();
        //Backup
        $schedule->command('backup:run --only-db')->weekly()->withoutOverlapping();
        //Promotion
        $schedule->command('promotion:inactive')->daily()->withoutOverlapping();
        //Cart
        $schedule->command('cart:forgotten')->dailyAt('23:00')->withoutOverlapping();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
