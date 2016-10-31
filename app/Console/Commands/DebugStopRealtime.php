<?php

namespace App\Console\Commands;

use App\Siri\SiriClient;
use Illuminate\Console\Command;

class DebugStopRealtime extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'query:realtime {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get realtime data for a stop.';

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
        $id = $this->argument('id');

        // Get realtime data
        $client = new SiriClient();
        $resp = $client->getRealtimeData($id);

        $this->info('Realtime data for stop ' . $id . '.');
        foreach ($resp as $visit) {
            $this->comment('[' . $visit->lineRef . '] ' . date('Y-m-d g:i:s A T', $visit->estimatedArrivalTime));
        }
    }
}
