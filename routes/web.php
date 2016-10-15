<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

if (config('app.debug')) {

    // Test route that dumps realtime data for a particular stop code.
    Route::get('/debug/stopdata/{id}', function ($id) {
        $client = new \App\Siri\SiriClient();
        $resp = $client->getRealtimeData($id);
        var_dump($resp);
    });

}
