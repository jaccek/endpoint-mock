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

// remove project
Route::get('proj/{projName}/del', 'ProjectListController@removeProject');

// list of endpoints
Route::get('proj/{projName}', 'EndpointListController@showList');
Route::post('proj/{projName}', 'EndpointListController@addEndpoint');

// management of single endpoint
Route::get('proj/{projName}/edit/{endpointName}', 'SingleEndpointController@showEditable');
Route::post('proj/{projName}/edit/{endpointName}', 'SingleEndpointController@editEndpoint');

// remove endpoint
Route::get('proj/{projName}/edit/{endpointName}/del', 'SingleEndpointController@removeEndpoint');

// remove endpoint parameter
Route::get('proj/{projName}/edit/{endpointName}/param/del/{parameterId}', 'SingleEndpointController@removeParameter');

// query endpoint
Route::any('proj/{projName}/query/{endpointName}', 'SingleEndpointController@query');

// list of modifications
Route::get('proj/{projName}/mod', 'ModificationController@showList');
Route::post('proj/{projName}/mod', 'ModificationController@addModification');

// remove modification
Route::get('proj/{projName}/mod/del/{modId}', 'ModificationController@removeModification');

// edit modification
Route::get('proj/{projName}/mod/{modId}', 'ModificationController@showEditable');
Route::post('proj/{projName}/mod/{modId}', 'ModificationController@editModification');
