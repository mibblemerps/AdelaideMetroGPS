<?php

namespace App\Console\Commands;

use App\Gtfs\Parser;
use App\Gtfs\Route;
use Illuminate\Console\Command;
use Illuminate\Database\QueryException;

class PopulateRoutes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'populate:routes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Populate routes from GTFS data.';

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

        // Delete old routes
        $this->comment('Deleting old routes from database...');
        Route::truncate();

        // Parse routes GTFS data
        $filePath = $gtfsPath . '/routes.txt';
        $this->comment('Parsing GTFS data from "' . $filePath . '"');
        $routes = Parser::parseRoutes($filePath);

        // Load routes into database.
        $this->comment('Saving routes into database...');
        $i = 0;
        foreach ($routes as $route) {
            try {
                $route->save();
                $i++;
            } catch (QueryException $ex) {
                $this->error('QueryException when trying to save ' . $route->id . '! ' . $ex->getMessage());
            }
        }

        $this->info('Success! Saved ' . $i . ' routes!');
    }
}
