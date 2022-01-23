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

$router->group(['prefix' => 'api'], function () use ($router) {
    //http://localhost:8000/api/garden

        // get request show garden:  id, name, area_m, city
    $router->get('garden',  ['uses' => 'GardenController@showGarden']);
        //Create Garden
    $router->post('garden', ['uses' => 'GardenController@createGarden']);
        //Update Garden
    $router->put('garden/{id}', ['uses' => 'GardenController@updateGarden']);

    //http://localhost:8000/api/users

        // get request Show users
    $router->get('users',  ['uses' => 'UserController@showAllUsers']);
        //get request Email & Password Login
    $router->get('login',  ['uses' => 'UserController@getUserLogin']);
        //POST new user request firstName lastName email password Register
    $router->post('userRegister', ['uses' => 'UserController@register']);
        //POST add user invitation request firstName lastName email password role:'assist','respond','view'
    $router->post('invitation/{userID}', ['uses' => 'UserController@invitation']);
        //Delete user id
    $router->delete('user/{id}/{userID}', ['uses' => 'UserController@deleteUser']);
        //Update user request+id
    $router->put('user/{id}', ['uses' => 'UserController@updateUser']);

    //http://localhost:8000/api/alarms

        // get request Show alarms
    $router->get('alarms',  ['uses' => 'AlarmController@showAllAlarms']);
        // get request Show user's alarm 
    $router->get('userAlarms/{id}', ['uses' => 'AlarmController@getUserAlarms']);
        // Create alarm request+userID
    $router->post('alarms/{userID}', ['uses' => 'AlarmController@createAlarm']);
        //Delete alarm userID roles
    $router->delete('alarms/{id}/{userID}', ['uses' => 'AlarmController@deleteAlarm']);
        //Update Alarm userID roles
    $router->put('alarms/{id}/{userID}', ['uses' => 'AlarmController@updateAlarm']);

    //http://localhost:8000/api/notes

        // get request Show notes
    $router->get('notes',  ['uses' => 'NoteController@showAllNotes']);
        // get request Show notes
    $router->get('notes/{id}', ['uses' => 'NoteController@getUserNotes']);
        // Create Note request+userID
    $router->post('note/{userID}', ['uses' => 'NoteController@createNote']);
        //Delete Note userID roles
    $router->delete('notes/{id/{userID}}', ['uses' => 'NoteController@deleteNote']);
        //Update Note userID roles
    $router->put('note/{id}/{userID}', ['uses' => 'NoteController@updateNote']);
    
    
    //http://localhost:8000/api/plants

        // Get request Show all plants
    $router->get('plants',  ['uses' => 'PlantsGardenController@showPlants']);
        // Get request "name" Search plants
    $router->get('plant',  ['uses' => 'PlantsGardenController@searchPlant']);
        // POST request "name" Search plants
    $router->post('plant',  ['uses' => 'PlantsGardenController@addPlantToGarden']);
        // Get all plants that i have in my garden -showMyplants($id)-
    $router->get('plantsGarden',  ['uses' => 'PlantsGardenController@showMyplants']);
        // Delete plant from my garden -deletePlant($id),$userID-
    $router->delete('deletePlant/{id}/{userID}',  ['uses' => 'PlantsGardenController@deletePlant']);
});




