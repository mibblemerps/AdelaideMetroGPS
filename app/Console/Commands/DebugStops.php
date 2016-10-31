<?php

namespace App\Console\Commands;

use App\Gtfs\Stop;
use Illuminate\Console\Command;

class DebugStops extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'query:stops
                            {id? : Stop code}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Query stops. Don\'t provide a stopcode to get a summary.';

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
     * @return mixed
     */
    public function handle()
    {
        if ($this->argument('id') === null) {
            $this->summary();
        } else {
            $this->query();
        }
    }

    /**
     * Summary of all stops on the transit network.
     */
    public function summary()
    {
        $this->info('There are ' . Stop::count() . ' stops in the transit network.');
    }

    /**
     * Query stop from stop code.
     */
    public function query()
    {
        $id = $this->argument('id');

        $stop = Stop::where('stop_code', $id)->first();

        if ($stop === null) {
            $this->warn('No stop with stopcode "' . $id . '".');
            return;
        }

        $this->info('Stop ' . $stop->stop_code . ' (' . $stop->name . ')');
        $this->comment('   Coordinates: ' . $stop->lat . ' ' . $stop->long);
        if ($stop->description !== null) {
            $this->comment('   Description: ' . $stop->description);
        }
    }
}
