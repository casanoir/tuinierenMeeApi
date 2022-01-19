<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});



//http://localhost:8000/api/gardens
$router->group(['prefix' => 'api'], function () use ($router) {
    // get request
    $router->get('gardens',  ['uses' => 'GardenController@showGarden']);
    
    //others request
    $router->post('gardens', ['uses' => 'GardenController@createGarden']);
    $router->put('gardens/{id}', ['uses' => 'GardenController@updateGarden']);
});



//http://localhost:8000/api/users
$router->group(['prefix' => 'api'], function () use ($router) {
        // get request
    $router->get('users',  ['uses' => 'UserController@showAllUsers']);

        //get request Show User Email & Password
    $router->get('loginD',  ['uses' => 'UserController@getUserLogin']);
    $router->get('user/{id}',  ['uses' => 'UserController@showUser']);

        //others request
    $router->post('users', ['uses' => 'UserController@createUser']);
    $router->delete('users/{id}', ['uses' => 'UserController@deleteUser']);
    $router->put('users/{id}', ['uses' => 'UserController@updateUser']);
});


//http://localhost:8000/api/alarms
$router->group(['prefix' => 'api'], function () use ($router) {
        // get request
    $router->get('alarms',  ['uses' => 'AlarmController@showAllAlarms']);
    $router->get('alarms/{id}', ['uses' => 'AlarmController@getUserAlarms']);
        //others request
    $router->post('alarms', ['uses' => 'AlarmController@createAlarm']);
    $router->delete('alarms/{id}', ['uses' => 'AlarmController@deleteAlarm']);
    $router->put('alarms/{id}', ['uses' => 'AlarmController@updateAlarm']);
});


//http://localhost:8000/api/notes
$router->group(['prefix' => 'api'], function () use ($router) {
        // get request
    $router->get('notes',  ['uses' => 'NoteController@showAllNotes']);
    $router->get('notes/{id}', ['uses' => 'NoteController@getUserNotes']);
        //others request
    $router->post('notes', ['uses' => 'NoteController@createNote']);
    $router->delete('notes/{id}', ['uses' => 'NoteController@deleteNote']);
    $router->put('notes/{id}', ['uses' => 'NoteController@updateNote']);
});