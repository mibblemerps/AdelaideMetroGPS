<?php

namespace App\Console;

use App\Console\Commands\DebugRoutes;
use App\Console\Commands\PopulateRoutes;
use App\Console\Commands\PopulateShapes;
use App\Console\Commands\PopulateStops;
use App\Console\Commands\PopulateTrips;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        PopulateRoutes::class,
        PopulateShapes::class,
        PopulateStops::class,
        PopulateTrips::class,

        DebugRoutes::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
