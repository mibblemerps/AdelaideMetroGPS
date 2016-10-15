<?php

namespace App\Console\Commands;

use App\Gtfs\Parser;
use App\Gtfs\Shape;
use Illuminate\Console\Command;

class PopulateShapes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'populate:shapes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Populate shapes from GTFS data.';

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
        $this->comment('Deleting old shapes from database...');
        Shape::truncate();

        // Parse GTFS data
        $filePath = $gtfsPath . '/shapes.txt';
        $this->comment('Parsing and saving GTFS data from "' . $filePath . '"');
        $this->comment('This may take many minutes, depending on the size of the transit network.');
        $shapes = Parser::parseShapes($filePath, function ($chunk) {
            foreach ($chunk as $shapePoint) {
                $shapePoint->save();
            }
        });

        $this->info('Success! Saved shape points!');
    }
}
