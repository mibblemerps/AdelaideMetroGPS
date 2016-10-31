<?php

namespace App\Console\Commands;

use App\Gtfs\Route;
use App\Gtfs\RouteType;
use Illuminate\Console\Command;

class DebugRoutes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'query:route
                            {id? : The ID of the route}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Query routes. Don\'t provide a route ID to get a route listing.';

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
            $this->listAll();
        } else {
            $this->query();
        }
    }

    /**
     * List all routes.
     */
    public function listAll()
    {
        $this->info('Listing all routes...');

        Route::chunk(50, function ($routes) {
            foreach ($routes as $route) {
                $this->line('Route ' . $route->short_name . "\t" . $route->full_name);
            }
        });
    }

    /**
     * Query route.
     */
    public function query()
    {
        $id = $this->argument('id');

        $route = Route::where('id', $id)->first();

        if ($route === null) {
            $this->warn('No route with ID "' . $id . '".');
            return;
        }

        $this->info('Route ' . $route->short_name . ' (' . $route->full_name . ')');
        $this->comment('   Route Type: ' . RouteType::$routeTypeNames[$route->route_type]);
        $this->comment('   Route URL: ' . $route->route_url);
        $this->comment('   Route Colour (text/bg): ' . $route->route_text_colour . '/' . $route->route_colour);
        $this->comment('   Description: ' . $route->description);
    }
}
