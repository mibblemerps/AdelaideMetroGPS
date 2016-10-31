<?php

namespace App\Console\Commands;

use App\Gtfs\Parser;
use App\Gtfs\Stop;
use Illuminate\Console\Command;
use Illuminate\Database\QueryException;

class PopulateStops extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'populate:stops';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Populate stops from GTFS data.';

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
        $gtfsPath = resource_path('gtfs');

        // Delete old stops
        $this->comment('Deleting old stops from database...');
        Stop::truncate();

        // Parse stops GTFS data
        $filePath = $gtfsPath . '/stops.txt';
        $this->comment('Parsing GTFS data from "' . $filePath . '"');
        $stops = Parser::parseStops($filePath);

        // Load stops into database.
        $this->comment('Saving stops into database...');
        $i = 0;
        foreach ($stops as $stop) {
            try {
                $stop->save();
                $i++;
            } catch (QueryException $ex) {
                $this->error('QueryException when trying to save ' . $stop->id . '! This could cause problems.' . "\r\n" . $ex->getMessage());
            }
        }

        $this->info('Success! Saved ' . $i . ' stops!');
    }
}
