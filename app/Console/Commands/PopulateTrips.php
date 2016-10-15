<?php

namespace App\Console\Commands;

use App\Gtfs\Parser;
use App\Gtfs\Route;
use App\Gtfs\Stop;
use App\Gtfs\Trip;
use Illuminate\Console\Command;
use Illuminate\Database\QueryException;

class PopulateTrips extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'populate:trips';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Populate trips from GTFS data.';

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

        // Delete old trips
        $this->comment('Deleting old trips from database...');
        Trip::truncate();

        // Parse trips GTFS data
        $filePath = $gtfsPath . '/trips.txt';
        $this->comment('Parsing GTFS data from "' . $filePath . '"');
        $trips = Parser::parseTrips($filePath);

        // Load trips into database.
        $this->comment('Saving trips into database...');
        $i = 0;
        foreach ($trips as $trip) {
            try {
                $trip->save();
                $i++;
            } catch (QueryException $ex) {
                $this->error('QueryException when trying to save ' . $trip->id . '! This could cause problems.' . "\r\n" . $ex->getMessage());
            }
        }

        $this->info('Success! Saved ' . $i . ' trips!');
    }
}
