<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/test', function() {
    $x = ["abc" => ["c" => 4, "b" => 2, "x" => [2,3,4]]];
    array_set($x, "abc.c", 80);
    array_set($x, "abc.x.0", 30);
    $c = array_get($x, "abc.x");
    $c[] = 50;
    array_set($x, "abc.x", $c);

    return response()->json($x);
});

// list of projects
Route::get('/', 'ProjectListController@showList');
Route::post('/', 'ProjectListController@addProject');

// list of endpoints
Route::get('{projName}', 'EndpointListController@showList');
Route::post('{projName}', 'EndpointListController@addEndpoint');

// management of single endpoint
// Route::get('{projName}/{endpointName}/cms', controller);

// query endpoint
Route::any('{projName}/{endpointName}', 'SingleEndpointController@query');
